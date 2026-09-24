<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->boolean('show_date')->default(true)->after('date');
        });
    }

    public function down(): void
    {
        Schema::table('deforestory', fn (Blueprint $table) => $table->dropColumn('show_date'));
    }
};
