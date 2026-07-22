<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_pages', function (Blueprint $table) {
            $table->boolean('whatsapp_enabled')->default(false)->after('faq_enabled');
            $table->string('whatsapp_number')->nullable()->after('whatsapp_enabled');
            $table->json('whatsapp_message')->nullable()->after('whatsapp_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_pages', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_enabled', 'whatsapp_number', 'whatsapp_message']);
        });
    }
};
