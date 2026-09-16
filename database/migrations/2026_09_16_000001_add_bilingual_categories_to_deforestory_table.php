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
            $table->string('category_id')->nullable()->after('category');
            $table->string('category_en')->nullable()->after('category_id');
        });

        DB::table('deforestory')
            ->whereNotNull('category')
            ->whereNull('category_id')
            ->update(['category_id' => DB::raw('category')]);

        DB::table('deforestory')
            ->whereNotNull('category')
            ->whereNull('category_en')
            ->update(['category_en' => DB::raw('category')]);
    }

    public function down(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->dropColumn(['category_id', 'category_en']);
        });
    }
};
