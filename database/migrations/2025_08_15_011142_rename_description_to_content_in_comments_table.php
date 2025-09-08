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
        // Check if description column exists before renaming
        if (Schema::hasColumn('comments', 'description')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->renameColumn('description', 'content');
            });
        }
        // If content column already exists, do nothing
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check if content column exists before renaming back
        if (Schema::hasColumn('comments', 'content') && !Schema::hasColumn('comments', 'description')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->renameColumn('content', 'description');
            });
        }
    }
};
