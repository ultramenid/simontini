<?php

namespace App\Console\Commands;

use App\Jobs\SendDeforestationStoryUpdateEmail;
use App\Services\PasopatiReportClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WatchPasopatiDeforestationUpdates extends Command
{
    protected $signature = 'deforestory:watch-pasopati
                            {uuid : UUID Deforestory yang dipantau}
                            {--interval=2 : Jeda pengecekan dalam detik}
                            {--once : Jalankan satu kali lalu berhenti}';

    protected $description = 'Memantau laporan Pasopati baru untuk pengujian Simontini lokal';

    public function handle(PasopatiReportClient $client): int
    {
        if (! app()->environment('local', 'testing')) {
            $this->error('Command ini hanya boleh dijalankan pada environment local/testing.');

            return self::FAILURE;
        }

        $uuid = (string) $this->argument('uuid');
        $story = DB::table('deforestory')->where('uuid', $uuid)->first(['id', 'uuid']);

        if (! $story) {
            $this->error('Deforestory dengan UUID tersebut tidak ditemukan.');

            return self::FAILURE;
        }

        $interval = max(1, (int) $this->option('interval'));
        $initializedKey = "pasopati:local-watch:initialized:{$uuid}";

        do {
            $reportsId = $client->forStory($uuid, 'id');
            $reportsEn = $client->forStory($uuid, 'en');

            if ($reportsId === null || $reportsEn === null) {
                $this->warn('Pasopati belum dapat dihubungi. Mencoba kembali...');
            } else {
                $englishById = $reportsEn->keyBy(fn (object $report): string => (string) $report->id);
                $isInitialScan = ! Cache::has($initializedKey);

                foreach ($reportsId->sortBy('published_at') as $reportId) {
                    $seenKey = "pasopati:local-watch:seen:{$uuid}:{$reportId->id}";

                    if (! Cache::add($seenKey, true, now()->addDays(7))) {
                        continue;
                    }

                    if ($isInitialScan) {
                        continue;
                    }

                    $reportEn = $englishById->get((string) $reportId->id, $reportId);

                    SendDeforestationStoryUpdateEmail::dispatch((int) $story->id, [
                        'title_id' => $reportId->title_id,
                        'title_en' => $reportEn->title_en,
                        'description_id' => $reportId->description_id,
                        'description_en' => $reportEn->description_en,
                        'image_url_id' => $reportId->image_url,
                        'image_url_en' => $reportEn->image_url,
                        'target_url_id' => $reportId->target_url,
                        'target_url_en' => $reportEn->target_url,
                        'published_at' => $reportId->published_at,
                    ]);

                    $this->info("Laporan baru diterima: {$reportId->title_id} — email masuk queue.");
                }

                Cache::forever($initializedKey, true);

                if ($isInitialScan) {
                    $this->info('Data Pasopati saat ini ditandai. Menunggu laporan baru...');
                }
            }

            if ($this->option('once')) {
                break;
            }

            sleep($interval);
        } while (true);

        return self::SUCCESS;
    }
}
