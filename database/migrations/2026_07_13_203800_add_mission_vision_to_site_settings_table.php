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
            $table->string('home_mission_title')->nullable();
            $table->text('home_mission_text')->nullable();
            $table->string('home_vision_title')->nullable();
            $table->text('home_vision_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['home_mission_title', 'home_mission_text', 'home_vision_title', 'home_vision_text']);
        });
    }
};
