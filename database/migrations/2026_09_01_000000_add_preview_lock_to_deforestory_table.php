<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deforestory', function (Blueprint $table) {
            $table->boolean('is_locked')->default(false)->after('status');
        });

        Schema::create('deforestory_preview_settings', function (Blueprint $table) {
            $table->id();
            $table->string('password_hash')->nullable();
            $table->text('password_encrypted')->nullable();
            $table->timestamps();
        });

        DB::table('deforestory_preview_settings')->insert([
            'id' => 1,
            'password_hash' => null,
            'password_encrypted' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('deforestory_preview_settings');

        Schema::table('deforestory', fn (Blueprint $table) => $table->dropColumn('is_locked'));
    }
};
