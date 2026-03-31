<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path');                    // stored path e.g. sliders/hero1.jpg
            $table->string('button_text')->nullable();       // e.g. "Learn More"
            $table->string('button_url')->nullable();        // e.g. "/services"
            $table->string('button_text_2')->nullable();     // secondary CTA
            $table->string('button_url_2')->nullable();
            $table->string('badge_label')->nullable();       // small eyebrow badge e.g. "New Service"
            $table->string('overlay_color')->default('#000000'); // hex — controls dark overlay tint
            $table->unsignedTinyInteger('overlay_opacity')->default(50); // 0-100
            $table->unsignedSmallInteger('order')->default(0);  // drag-to-reorder support
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};