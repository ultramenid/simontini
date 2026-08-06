<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->string('image')->nullable()->after('external_id');
        });
    }

    public function down(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
