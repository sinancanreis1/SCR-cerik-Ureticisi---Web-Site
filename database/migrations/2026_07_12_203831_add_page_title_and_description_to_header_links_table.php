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
            $table->string('page_title')->nullable()->after('page_template');
            $table->text('page_description')->nullable()->after('page_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('header_links', function (Blueprint $table) {
            $table->dropColumn(['page_title', 'page_description']);
        });
    }
};
