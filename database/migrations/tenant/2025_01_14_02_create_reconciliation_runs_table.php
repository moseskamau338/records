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
        Schema::create('reconciliation_runs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->timestamp('run_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status',['in_progress', 'completed', 'failed'])->default('in_progress');
            $table->integer('processed_records');
            $table->integer('matched_records');
            $table->integer('unmatched_records');
            $table->timestamps();


            $table->foreign('template_id')->references('id')->on('reconciliation_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reconciliation_runs');
    }
};
