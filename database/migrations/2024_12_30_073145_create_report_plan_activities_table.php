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
        Schema::create('report_plan_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('laporan_id')->constrained('reports')->cascadeOnDelete();
            $table->text('tema_kegiatan')->nullable();
            $table->text('deskripsi_kegiatan')->nullable();
            $table->text('penyelenggara_kegiatan')->nullable();
            $table->text('pemateri_narasumber')->nullable();
            $table->text('peserta_kegiatan')->nullable();
            $table->text('waktu_pelaksanaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_plan_activities');
    }
};
