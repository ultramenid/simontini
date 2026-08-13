<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deforestation_email_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')
                ->constrained('deforestation_story_subscriptions')
                ->cascadeOnDelete();
            $table->foreignId('story_id')
                ->constrained('deforestory')
                ->cascadeOnDelete();
            $table->string('event_key', 64);
            $table->enum('status', ['processing', 'sent'])->default('processing');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->unique(
                ['subscription_id', 'story_id', 'event_key'],
                'deforestation_email_delivery_unique',
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deforestation_email_deliveries');
    }
};
