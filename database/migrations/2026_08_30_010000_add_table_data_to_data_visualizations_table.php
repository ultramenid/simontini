<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_visualizations', function (Blueprint $table) {
            $table->string('chart_type', 20)->default('bar')->after('description');
            $table->json('chart_data')->nullable()->after('chart_type');
            $table->text('embed_url')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('data_visualizations', function (Blueprint $table) {
            $table->dropColumn(['chart_type', 'chart_data']);
            $table->text('embed_url')->nullable(false)->change();
        });
    }
};
