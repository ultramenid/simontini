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
            $table->string('region')->nullable()->after('category_en');
            $table->string('region_id')->nullable()->after('region');
            $table->string('region_en')->nullable()->after('region_id');
        });

        DB::table('deforestory')
            ->whereNotNull('region')
            ->whereNull('region_id')
            ->update(['region_id' => DB::raw('region')]);

        DB::table('deforestory')
            ->whereNotNull('region')
            ->whereNull('region_en')
            ->update(['region_en' => DB::raw('region')]);
    }

    public function down(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->dropColumn(['region', 'region_id', 'region_en']);
        });
    }
};
