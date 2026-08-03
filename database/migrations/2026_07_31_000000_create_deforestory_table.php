<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deforestory', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en');
            $table->text('desrkirpsi_id');
            $table->text('desrkirpsi_en');
            $table->date('date');
            $table->longText('content_id');
            $table->longText('content_en');
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deforestory');
    }
};
