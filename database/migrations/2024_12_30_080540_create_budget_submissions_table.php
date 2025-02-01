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
        Schema::create('budget_submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('formulir_id')->constrained('formulirs')->cascadeOnDelete();
            $table->string('keterangan')->nullable();
            $table->string('jumlah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_submissions');
    }
};
