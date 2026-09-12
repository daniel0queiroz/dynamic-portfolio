<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('feedback_section_settings', function (Blueprint $table) {
            $table->json('cta_label')->nullable()->after('sub_title');
        });
    }

    public function down()
    {
        Schema::table('feedback_section_settings', function (Blueprint $table) {
            $table->dropColumn('cta_label');
        });
    }
};
