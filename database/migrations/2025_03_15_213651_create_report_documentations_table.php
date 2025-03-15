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
        Schema::create('report_documentations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('laporan_id')->constrained('reports')->cascadeOnDelete();
            $table->string('file_dokumentasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_documentations');
    }
};
