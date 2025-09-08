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
        // This migration was created to fix missing columns, but the columns already exist
        // in the original create_tags_table migration. No action needed.
    }

    /**
     * Reverse the migrationsss
     */
    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn(['name', 'slug']);
        });
    }
};
