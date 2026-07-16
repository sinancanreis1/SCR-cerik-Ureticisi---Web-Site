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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('features_title')->nullable()->after('description');
            $table->json('features')->nullable()->after('features_title');
            $table->text('bottom_description')->nullable()->after('features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['features_title', 'features', 'bottom_description']);
        });
    }
};
