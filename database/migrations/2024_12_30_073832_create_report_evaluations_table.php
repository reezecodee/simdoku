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
        Schema::create('report_evaluations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('laporan_id')->constrained('reports');
            $table->string('peserta_daftar')->nullable();
            $table->string('peserta_hadir')->nullable();
            $table->string('peserta_puas')->nullable();
            $table->string('peserta_cukup_puas')->nullable();
            $table->string('peserta_tidak_puas')->nullable();
            $table->string('penilaian_sangat_bagus')->nullable();
            $table->string('penilaian_cukup_bagus')->nullable();
            $table->string('penilaian_kurang_bagus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_evaluations');
    }
};
