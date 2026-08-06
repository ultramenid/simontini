<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deforestation_story_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deforestory_id')->constrained('deforestory')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('email');
            $table->string('locale', 2)->default('id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('unsubscribe_token', 64)->unique();
            $table->timestamps();

            $table->unique(['deforestory_id', 'email']);
            $table->index(['deforestory_id', 'status']);
        });

        Schema::create('deforestation_story_update_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('update_id')->constrained('deforestation_story_updates')->cascadeOnDelete();
            $table->foreignId('subscription_id')->constrained('deforestation_story_subscriptions')->cascadeOnDelete();
            $table->enum('status', ['queued', 'sent', 'failed'])->default('queued');
            $table->timestamp('sent_at')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();

            $table->unique(['update_id', 'subscription_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deforestation_story_update_notifications');
        Schema::dropIfExists('deforestation_story_subscriptions');
    }
};
