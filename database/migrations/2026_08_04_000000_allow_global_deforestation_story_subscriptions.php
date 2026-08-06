<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestation_story_subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('deforestory_id')->nullable()->change();
        });

        if (DB::getDriverName() === 'pgsql') {
            DB::statement('CREATE UNIQUE INDEX deforestation_global_subscription_email_unique ON deforestation_story_subscriptions (email) WHERE deforestory_id IS NULL');
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('DROP INDEX IF EXISTS deforestation_global_subscription_email_unique');
        }

        DB::table('deforestation_story_subscriptions')->whereNull('deforestory_id')->delete();

        Schema::table('deforestation_story_subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('deforestory_id')->nullable(false)->change();
        });
    }
};
