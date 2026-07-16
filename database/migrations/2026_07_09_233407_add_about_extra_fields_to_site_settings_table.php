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
            // Hero / Banner alanları
            $table->string('about_hero_image')->nullable();
            $table->string('about_hero_subtitle')->nullable();
            $table->string('about_hero_title')->nullable();
            $table->text('about_hero_desc')->nullable();
            // Hakkımızda tanıtım görseli
            $table->string('about_intro_image')->nullable();
            // İstatistikler
            $table->integer('about_stat_years')->nullable();
            $table->integer('about_stat_patients')->nullable();
            $table->integer('about_stat_staff')->nullable();
            // Hizmet Alanlarımız (tekrarlanan liste)
            $table->json('about_services')->nullable();
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
