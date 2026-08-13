<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comment_users', function (Blueprint $table) {
            $table->id();
            $table->string('provider', 30)->default('google');
            $table->string('provider_user_id');
            $table->string('name');
            $table->string('email')->nullable()->index();
            $table->string('avatar', 2048)->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();

            $table->unique(['provider', 'provider_user_id']);
        });

        Schema::create('story_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained('deforestory')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('story_comments')->cascadeOnDelete();
            $table->foreignId('comment_user_id')->nullable()->constrained('comment_users')->nullOnDelete();
            $table->string('user_provider', 30)->default('google');
            $table->string('user_id');
            $table->string('user_name', 60);
            $table->string('user_email')->nullable();
            $table->string('user_avatar', 2048)->nullable();
            $table->text('comment');
            $table->enum('status', ['pending', 'approved', 'hidden', 'rejected', 'spam'])->default('pending');
            $table->timestamps();

            $table->index(['story_id', 'status', 'created_at']);
            $table->index(['parent_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('story_comments');
        Schema::dropIfExists('comment_users');
    }
};
