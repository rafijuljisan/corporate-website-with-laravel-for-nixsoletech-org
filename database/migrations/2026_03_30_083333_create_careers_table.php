<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('vacancy')->nullable();
            $table->text('job_context')->nullable();
            $table->text('job_responsibilities')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('workplace')->nullable();
            $table->text('educational_requirements')->nullable();
            $table->text('experience_requirements')->nullable();
            $table->text('additional_requirements')->nullable();
            $table->string('job_location')->nullable();
            $table->string('salary')->nullable();
            $table->text('compensation_benefits')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Index for fast public loading
            $table->index('is_active'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};