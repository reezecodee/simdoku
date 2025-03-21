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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('beasiswa_id')->constrained('scholarships')->cascadeOnDelete();
            $table->string('asal_sekolah')->nullable();
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('nama_peserta_didik')->nullable();
            $table->enum('kelas', ['X', 'XI', 'XII', 'XIII'])->nullable();
            $table->string('jurusan')->nullable();
            $table->enum('rangking', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])->nullable();
            $table->string('besaran_beasiswa')->nullable();
            $table->string('status_loa')->nullable();
            $table->string('status_sk_rektor')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->string('tgl_ajuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
