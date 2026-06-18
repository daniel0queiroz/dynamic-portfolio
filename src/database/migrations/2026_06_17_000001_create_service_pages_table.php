<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->json('title');
            $table->json('subtitle');
            $table->string('image')->nullable();
            $table->string('video_url', 500)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_pages');
    }
};
