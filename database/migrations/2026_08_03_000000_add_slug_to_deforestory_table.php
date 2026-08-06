<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title_en');
        });

        DB::table('deforestory')
            ->select(['id', 'title_id'])
            ->orderBy('id')
            ->each(function ($story): void {
                $baseSlug = Str::slug($story->title_id) ?: 'deforestation-story';
                $slug = $baseSlug;
                $suffix = 2;

                while (DB::table('deforestory')->where('slug', $slug)->exists()) {
                    $slug = $baseSlug.'-'.$suffix;
                    $suffix++;
                }

                DB::table('deforestory')->where('id', $story->id)->update(['slug' => $slug]);
            });

        Schema::table('deforestory', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
