<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->timestamp('first_published_at')->nullable()->after('status');
        });

        // Story yang sedang publish atau pernah mempunyai notifikasi dianggap
        // sudah melewati publish pertama agar republish tidak mengirim ulang.
        DB::table('deforestory')
            ->where('status', 'publish')
            ->whereNull('first_published_at')
            ->update(['first_published_at' => DB::raw('COALESCE(created_at, updated_at, CURRENT_TIMESTAMP)')]);

        if (Schema::hasTable('deforestation_story_publication_notifications')) {
            $notifiedStoryIds = DB::table('deforestation_story_publication_notifications')
                ->distinct()
                ->pluck('story_id');

            if ($notifiedStoryIds->isNotEmpty()) {
                DB::table('deforestory')
                    ->whereIn('id', $notifiedStoryIds)
                    ->whereNull('first_published_at')
                    ->update(['first_published_at' => DB::raw('COALESCE(created_at, updated_at, CURRENT_TIMESTAMP)')]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->dropColumn('first_published_at');
        });
    }
};
