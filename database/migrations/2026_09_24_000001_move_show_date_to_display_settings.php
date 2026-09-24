<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Tampilan tanggal jadi setelan global, bukan per artikel.
    public function up(): void
    {
        Schema::table('deforestory_display_settings', function (Blueprint $table) {
            $table->boolean('date_visible')->default(true);
        });

        if (Schema::hasColumn('deforestory', 'show_date')) {
            Schema::table('deforestory', fn (Blueprint $table) => $table->dropColumn('show_date'));
        }
    }

    public function down(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->boolean('show_date')->default(true)->after('date');
        });

        Schema::table('deforestory_display_settings', fn (Blueprint $table) => $table->dropColumn('date_visible'));
    }
};
