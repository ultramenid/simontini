<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('story_comments', function (Blueprint $table) {
            $table->timestamp('reply_notification_sent_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('story_comments', function (Blueprint $table) {
            $table->dropColumn('reply_notification_sent_at');
        });
    }
};
