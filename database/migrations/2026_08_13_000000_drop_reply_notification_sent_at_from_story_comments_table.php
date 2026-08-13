<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('story_comments', 'reply_notification_sent_at')) {
            Schema::table('story_comments', function (Blueprint $table) {
                $table->dropColumn('reply_notification_sent_at');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('story_comments', 'reply_notification_sent_at')) {
            Schema::table('story_comments', function (Blueprint $table) {
                $table->timestamp('reply_notification_sent_at')->nullable()->after('status');
            });
        }
    }
};
