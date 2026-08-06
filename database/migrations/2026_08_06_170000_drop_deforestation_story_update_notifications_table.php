<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('deforestation_story_update_notifications');
    }

    public function down(): void
    {
        Schema::create('deforestation_story_update_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('update_id')->constrained('deforestation_story_updates')->cascadeOnDelete();
            $table->foreignId('subscription_id')->constrained('deforestation_story_subscriptions')->cascadeOnDelete();
            $table->enum('status', ['queued', 'sent', 'failed'])->default('queued');
            $table->timestamp('sent_at')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();

            $table->unique(['update_id', 'subscription_id'], 'dsun_update_subscription_unique');
        });
    }
};
