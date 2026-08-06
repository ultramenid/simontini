<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deforestation_story_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deforestory_id')->constrained('deforestory')->cascadeOnDelete();
            $table->string('external_id')->unique();
            $table->string('title_id');
            $table->string('title_en');
            $table->text('description_id');
            $table->text('description_en');
            $table->string('image_url', 2048);
            $table->string('target_url', 2048);
            $table->date('published_at');
            $table->enum('status', ['on', 'off'])->default('on');
            $table->timestamps();

            $table->index(['deforestory_id', 'status', 'published_at'], 'dsu_deforestory_status_published_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deforestation_story_updates');
    }
};
