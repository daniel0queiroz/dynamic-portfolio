<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->json('role')->nullable()->after('position');
            $table->json('company')->nullable()->after('role');
            $table->boolean('is_active')->default(true)->after('description');
        });
    }

    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropColumn(['role', 'company', 'is_active']);
        });
    }
};
