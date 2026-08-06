<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reference_images', function (Blueprint $table) {
            $table->string('disk', 20)->default('public')->after('image_path');
            $table->string('original_name')->nullable()->after('disk');
            $table->string('mime_type')->nullable()->after('original_name');
            $table->unsignedBigInteger('file_size')->nullable()->after('mime_type');
        });
    }

    public function down(): void
    {
        Schema::table('reference_images', function (Blueprint $table) {
            $table->dropColumn(['disk', 'original_name', 'mime_type', 'file_size']);
        });
    }
};
