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
        Schema::table('header_links', function (Blueprint $table) {
            $table->boolean('is_dynamic_page')->default(false)->after('is_active');
            $table->string('page_template')->nullable()->after('is_dynamic_page');
        });

        Schema::create('dynamic_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('header_link_id')->constrained('header_links')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_items');
        
        Schema::table('header_links', function (Blueprint $table) {
            $table->dropColumn(['is_dynamic_page', 'page_template']);
        });
    }
};
