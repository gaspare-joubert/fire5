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
        // Add cascade delete to addresses
        Schema::table('addresses', function (Blueprint $table) {
            // Drop existing foreign key if exists
            if (Schema::hasColumn('addresses', 'user_id')) {
                $table->dropForeign(['user_id']);
            }

            // Add new foreign key with cascade
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // Add cascade delete to files
        Schema::table('files', function (Blueprint $table) {
            // Drop existing foreign key if exists
            if (Schema::hasColumn('files', 'user_id')) {
                $table->dropForeign(['user_id']);
            }

            // Add new foreign key with cascade
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // Add cascade delete to contact_user pivot table (for the relationship only)
        Schema::table('contact_user', function (Blueprint $table) {
            // Drop existing foreign key if exists
            if (Schema::hasColumn('contact_user', 'user_id')) {
                $table->dropForeign(['user_id']);
            }

            // Add new foreign key with cascade
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });

        Schema::table('contact_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }
};
