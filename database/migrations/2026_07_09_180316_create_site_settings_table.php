<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            
            // İletişim Bilgileri
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('map_url')->nullable();
            $table->string('whatsapp_number')->nullable();
            
            // Sosyal Medya
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            
            // Metinler
            $table->string('home_about_title')->nullable();
            $table->text('home_about_text')->nullable();
            $table->text('footer_about_text')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
