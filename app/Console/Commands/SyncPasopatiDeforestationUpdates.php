<?php

namespace App\Console\Commands;

use App\Jobs\SendDeforestationStoryUpdateEmail;
use App\Services\PasopatiReportClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SyncPasopatiDeforestationUpdates extends Command
{
    protected $signature = 'deforestory:sync-pasopati
                            {--seed : Tandai laporan saat ini tanpa mengirim email}
                            {--uuid= : Batasi sinkronisasi ke satu UUID Deforestory}';

    protected $description = 'Mendeteksi laporan Pasopati baru dan mengantrekan email subscriber Deforestory';

    public function handle(PasopatiReportClient $client): int
    {
        $storiesQuery = DB::table('deforestory')
            ->where('status', 'publish')
            ->whereNotNull('uuid');

        if (filled($this->option('uuid'))) {
            $storiesQuery->where('uuid', $this->option('uuid'));
        }

        $stories = $storiesQuery->get(['id', 'uuid']);

        $detected = 0;
        $queued = 0;

        foreach ($stories as $story) {
            $reportsId = $client->forStory((string) $story->uuid, 'id');
            $reportsEn = $client->forStory((string) $story->uuid, 'en');

            if ($reportsId === null || $reportsEn === null) {
                continue;
            }

            $englishById = $reportsEn->keyBy(fn (object $report): string => (string) $report->id);
            $initializedKey = "pasopati:reports:initialized:{$story->uuid}";
            $isInitialScan = ! Cache::has($initializedKey);

            foreach ($reportsId->sortBy('published_at') as $reportId) {
                $reportEn = $englishById->get((string) $reportId->id, $reportId);
                $fingerprint = hash('sha256', implode('|', [
                    $story->uuid,
                    $reportId->id,
                    $reportId->published_at,
                    $reportId->target_url,
                ]));
                $seenKey = "pasopati:reports:seen:{$fingerprint}";

                if (! Cache::add($seenKey, true, now()->addYears(5))) {
                    continue;
                }

                if ($this->option('seed') || $isInitialScan) {
                    continue;
                }

                $detected++;
                $article = [
                    'title_id' => $reportId->title_id,
                    'title_en' => $reportId->title_en,
                    'description_id' => $reportId->description_id,
                    'description_en' => $reportId->description_en,
                    'image_url' => $reportId->image_url,
                    'image_url_id' => $reportId->image_url,
                    'image_url_en' => $reportEn->image_url,
                    'target_url_id' => $reportId->target_url,
                    'target_url_en' => $reportEn->target_url,
                    'published_at' => $reportId->published_at,
                ];

                $subscriptions = DB::table('deforestation_story_subscriptions')
                    ->where('status', 'active')
                    ->where(fn ($query) => $query
                        ->where('deforestory_id', $story->id)
                        ->orWhereNull('deforestory_id'))
                    ->pluck('id');

                foreach ($subscriptions as $subscriptionId) {
                    SendDeforestationStoryUpdateEmail::dispatch(
                        (int) $subscriptionId,
                        (int) $story->id,
                        $article,
                    );
                    $queued++;
                }
            }

            Cache::forever($initializedKey, true);
        }

        $this->info("Sinkronisasi selesai: {$detected} laporan baru, {$queued} email masuk queue.");

        return self::SUCCESS;
    }
}
