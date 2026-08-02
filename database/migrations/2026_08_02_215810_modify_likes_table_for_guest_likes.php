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
        Schema::table('likes', function (Blueprint $table) {
            // Drop foreign key and unique constraint
            $table->dropForeign(['user_id']);
            $table->dropUnique(['user_id', 'likeable_id', 'likeable_type']);
        });

        Schema::table('likes', function (Blueprint $table) {
            // Make user_id nullable and add ip_address
            $table->foreignId('user_id')->nullable()->change();
            $table->string('ip_address')->nullable()->after('user_id');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('ip_address');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreignId('user_id')->change()->constrained()->cascadeOnDelete();
            $table->unique(['user_id', 'likeable_id', 'likeable_type']);
        });
    }
};
