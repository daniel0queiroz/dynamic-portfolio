<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_pages', function (Blueprint $table) {
            $table->boolean('lead_form_enabled')->default(true)->after('form_success_message');
            $table->boolean('faq_enabled')->default(true)->after('lead_form_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('service_pages', function (Blueprint $table) {
            $table->dropColumn(['lead_form_enabled', 'faq_enabled']);
        });
    }
};
