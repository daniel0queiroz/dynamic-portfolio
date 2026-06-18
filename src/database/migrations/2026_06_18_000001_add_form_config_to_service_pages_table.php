<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_pages', function (Blueprint $table) {
            $table->json('form_title')->nullable()->after('mobile_image');
            $table->json('form_subtitle')->nullable()->after('form_title');
            $table->json('cta_label')->nullable()->after('form_subtitle');
            $table->json('form_success_message')->nullable()->after('cta_label');
        });
    }

    public function down(): void
    {
        Schema::table('service_pages', function (Blueprint $table) {
            $table->dropColumn(['form_title', 'form_subtitle', 'cta_label', 'form_success_message']);
        });
    }
};
