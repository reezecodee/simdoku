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
        Schema::create('formulirs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul')->nullable();
            $table->string('kampus')->nullable();
            $table->string('tgl_pengajuan')->nullable();
            $table->string('pemohon')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('tanggal_diperlukan')->nullable();
            $table->foreignUuid('ttd_ka_devisi_mer')->nullable()->constrained('signatures');
            $table->foreignUuid('ttd_ka_baku')->nullable()->constrained('signatures');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulirs');
    }
};
