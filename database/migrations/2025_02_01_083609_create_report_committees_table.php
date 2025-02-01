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
        Schema::create('report_committees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('laporan_id')->constrained('reports')->cascadeOnDelete();
            $table->string('penasehat')->nullable();
            $table->string('pembina')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('ketua_pelaksana')->nullable();
            $table->string('moderator')->nullable();
            $table->string('publikasi_media')->nullable();
            $table->string('sie_konsumsi')->nullable();
            $table->string('sie_registrasi')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->string('sosialisasi')->nullable();
            $table->string('multimedia')->nullable();
            $table->string('perlengkapan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_committees');
    }
};
