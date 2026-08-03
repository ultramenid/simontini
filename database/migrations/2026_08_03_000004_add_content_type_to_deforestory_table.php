<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->string('content_type', 20)->default('template')->after('desrkirpsi_en');
        });
    }

    public function down(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->dropColumn('content_type');
        });
    }
};
