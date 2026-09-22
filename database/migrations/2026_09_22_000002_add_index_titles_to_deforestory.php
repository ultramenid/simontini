<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->string('index_title_id')->nullable();
            $table->string('index_title_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('deforestory', fn (Blueprint $table) => $table->dropColumn(['index_title_id', 'index_title_en']));
    }
};
