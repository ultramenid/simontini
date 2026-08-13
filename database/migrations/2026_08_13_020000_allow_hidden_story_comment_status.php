<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE story_comments DROP CONSTRAINT IF EXISTS story_comments_status_check');
            DB::statement("ALTER TABLE story_comments ADD CONSTRAINT story_comments_status_check CHECK (status IN ('pending', 'approved', 'hidden', 'rejected', 'spam'))");
        }

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE story_comments MODIFY status ENUM('pending', 'approved', 'hidden', 'rejected', 'spam') NOT NULL DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        DB::table('story_comments')->where('status', 'hidden')->update(['status' => 'rejected']);

        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE story_comments DROP CONSTRAINT IF EXISTS story_comments_status_check');
            DB::statement("ALTER TABLE story_comments ADD CONSTRAINT story_comments_status_check CHECK (status IN ('pending', 'approved', 'rejected', 'spam'))");
        }

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE story_comments MODIFY status ENUM('pending', 'approved', 'rejected', 'spam') NOT NULL DEFAULT 'pending'");
        }
    }
};
