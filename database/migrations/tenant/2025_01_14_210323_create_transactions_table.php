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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('source_id');
            $table->decimal('amount', 15, 2);
            $table->date('transaction_date');
            $table->string('external_reference')->nullable();
            $table->text('description')->nullable();

            // for dynamic stuff
            $table->json('metadata')->nullable(); // like the rest of the entry details
            $table->json('other_required_fields')->nullable(); // for template specific cases
            $table->timestamps();

            $table->foreign('template_id')->references('id')->on('reconciliation_templates')->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('reconciliation_sources')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
