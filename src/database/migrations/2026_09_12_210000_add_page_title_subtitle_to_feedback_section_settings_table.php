<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('feedback_section_settings', function (Blueprint $table) {
            $table->json('page_title')->nullable()->after('cta_label');
            $table->json('page_subtitle')->nullable()->after('page_title');
        });
    }

    public function down()
    {
        Schema::table('feedback_section_settings', function (Blueprint $table) {
            $table->dropColumn(['page_title', 'page_subtitle']);
        });
    }
};
