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
            $table->json('home_quiz_questions')->nullable();
            
            $table->string('home_features_title')->nullable();
            $table->string('home_features_subtitle')->nullable();
            $table->json('home_features')->nullable();
            
            $table->string('home_section4_type')->nullable()->default('products');
            $table->string('home_section4_title')->nullable();
            $table->string('home_section4_subtitle')->nullable();
            
            $table->string('home_steps_title')->nullable();
            $table->text('home_steps_description')->nullable();
            $table->json('home_steps')->nullable();
            
            $table->json('home_stats')->nullable();
            
            $table->string('home_section7_type')->nullable()->default('categories');
            $table->string('home_section7_title')->nullable();
            $table->string('home_section7_subtitle')->nullable();
            
            $table->string('home_testimonials_title')->nullable();
            $table->string('home_testimonials_subtitle')->nullable();
            $table->string('home_testimonials_widget_id')->nullable();
            
            $table->string('home_faq_title')->nullable();
            $table->text('home_faq_description')->nullable();
            $table->json('home_faqs')->nullable();
            
            $table->string('home_appointment_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'home_quiz_questions',
                'home_features_title', 'home_features_subtitle', 'home_features',
                'home_section4_type', 'home_section4_title', 'home_section4_subtitle',
                'home_steps_title', 'home_steps_description', 'home_steps',
                'home_stats',
                'home_section7_type', 'home_section7_title', 'home_section7_subtitle',
                'home_testimonials_title', 'home_testimonials_subtitle', 'home_testimonials_widget_id',
                'home_faq_title', 'home_faq_description', 'home_faqs',
                'home_appointment_title'
            ]);
        });
    }
};
