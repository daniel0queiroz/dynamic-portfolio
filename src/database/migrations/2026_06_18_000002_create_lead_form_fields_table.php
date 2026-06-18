<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_page_id')->constrained()->cascadeOnDelete();
            $table->json('label');
            $table->json('placeholder')->nullable();
            $table->enum('type', ['text', 'email', 'tel', 'textarea', 'select']);
            $table->json('options')->nullable();
            $table->boolean('is_required')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_form_fields');
    }
};
