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
            $table->uuid('uuid')->nullable()->unique();
        });

        DB::table('deforestory')
            ->whereNull('uuid')
            ->orderBy('id')
            ->eachById(function ($story) {
                DB::table('deforestory')
                    ->where('id', $story->id)
                    ->update(['uuid' => (string) Str::uuid()]);
            });
    }

    public function down(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
