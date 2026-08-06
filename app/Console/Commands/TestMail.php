<?php

namespace App\Console\Commands;

use App\Mail\NewDeforestationStoryPublished;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    protected $signature = 'test:mail {email} {--queue}';

    protected $description = 'Send a test deforestation-story email to verify mailer + queue pipeline';

    public function handle(): int
    {
        $email = (string) $this->argument('email');

        $mailable = new NewDeforestationStoryPublished([
            'name' => 'Test Recipient',
            'titleId' => '[TEST] Deforestory Uji Coba',
            'titleEn' => '[TEST] Deforestory Trial',
            'descriptionId' => 'Ini email uji coba dari Simontini untuk memverifikasi konfigurasi mailer dan queue worker.',
            'descriptionEn' => 'This is a Simontini test email to verify mailer config and the queue worker.',
            'imageUrl' => null,
            'storyUrlId' => route('deforestation.show', ['locale' => 'id', 'id' => 1, 'slug' => 'test']),
            'storyUrlEn' => route('deforestation.show', ['locale' => 'en', 'id' => 1, 'slug' => 'test']),
            'publishedAt' => now()->toDateString(),
        ]);

        if ($this->option('queue')) {
            Mail::to($email)->queue($mailable);
            $this->info("Queued test email to {$email}. Watch the worker log + jobs table.");
            $this->line('  tail -f storage/logs/worker.log');
            $this->line('  php artisan tinker --execute="echo DB::table(\'jobs\')->count();"');
            return self::SUCCESS;
        }

        Mail::to($email)->send($mailable);
        $this->info("Sent test email directly to {$email} (sync, bypasses the queue).");
        return self::SUCCESS;
    }
}