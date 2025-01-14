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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('run_id');
            $table->unsignedBigInteger('source_transaction_id');
            $table->unsignedBigInteger('target_transaction_id');
            $table->enum('match_status', ['matched', 'partial', 'unmatched']);
            $table->enum('approval_status', ['open', 'reviewed', 'resolved'])->nullable();
            $table->json('rule_applied');
            $table->json('anomaly_details');
            $table->timestamps();

            $table->foreign('template_id')->references('id')->on('reconciliation_templates')->onDelete('cascade');
            $table->foreign('run_id')->references('id')->on('reconciliation_runs')->onDelete('cascade');
            $table->foreign('source_transaction_id')->references('id')->on('transactions')->nullOnDelete();
            $table->foreign('target_transaction_id')->references('id')->on('transactions')->nullOnDelete();
        });

        // pivot for collaboration
        Schema::create('match_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comments');
            $table->enum('action', ['approve', 'reject'])->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Ensure combination is unique to prevent multiple entries for the same exception and user
            $table->unique(['match_id', 'action', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
        Schema::dropIfExists('match_user');
    }
};
