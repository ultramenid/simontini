<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deforestation_story_publication_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained('deforestory')->cascadeOnDelete();
            $table->unsignedBigInteger('subscription_id');
            $table->foreign('subscription_id', 'dspn_subscription_id_foreign')
                ->references('id')->on('deforestation_story_subscriptions')->cascadeOnDelete();
            $table->enum('status', ['queued', 'sent', 'failed'])->default('queued');
            $table->timestamp('sent_at')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();

            $table->unique(['story_id', 'subscription_id'], 'dspn_story_subscription_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deforestation_story_publication_notifications');
    }
};
