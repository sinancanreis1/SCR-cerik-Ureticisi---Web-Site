<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('about_intro_title')->nullable();
            $table->text('about_intro_text_1')->nullable();
            $table->text('about_intro_text_2')->nullable();
            $table->text('about_mission')->nullable();
            $table->text('about_vision')->nullable();
            $table->json('about_values')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            //
        });
    }
};
