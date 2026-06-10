<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('link_page_settings', function (Blueprint $table) {
            $table->id();
            $table->json('profile_name');
            $table->json('profile_bio');
            $table->string('default_locale', 5)->default('en');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('link_page_settings');
    }
};
