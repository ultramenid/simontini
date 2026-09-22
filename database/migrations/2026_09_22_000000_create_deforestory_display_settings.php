<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deforestory_display_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('category_clickable')->default(true);
            $table->boolean('region_clickable')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deforestory_display_settings');
    }
};
