<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Change the column from string to text
            $table->text('contact_map_embed')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Revert back to string if we ever roll back
            $table->string('contact_map_embed', 1000)->nullable()->change();
        });
    }
};