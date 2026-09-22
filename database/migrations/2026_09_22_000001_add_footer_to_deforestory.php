<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->longText('footer_id')->nullable();
            $table->longText('footer_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('deforestory', fn (Blueprint $table) => $table->dropColumn(['footer_id', 'footer_en']));
    }
};
