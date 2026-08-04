<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestation_story_publication_notifications', function (Blueprint $table) {
            $table->dropUnique(['story_id', 'subscription_id']);
        });
    }

    public function down(): void
    {
        // The unique constraint cannot be restored safely after valid
        // republish notification rows have been created.
    }
};
