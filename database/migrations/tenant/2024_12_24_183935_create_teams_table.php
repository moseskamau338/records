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
        // Create the teams table
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Create the pivot table for the many-to-many relationship
        Schema::create('team_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete(); // References the teams table
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // References the users table
            $table->timestamps(); // Useful for tracking when a user joined a team
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the pivot table first to avoid foreign key constraint errors
        Schema::dropIfExists('team_user');

        // Drop the teams table
        Schema::dropIfExists('teams');
    }
};
