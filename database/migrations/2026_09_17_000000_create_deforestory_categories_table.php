<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deforestory_categories', function (Blueprint $table) {
            $table->id();
            $table->string('label_id', 100);
            $table->string('label_en', 100);
            $table->string('pair_hash', 64)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deforestory_categories');
    }
};
