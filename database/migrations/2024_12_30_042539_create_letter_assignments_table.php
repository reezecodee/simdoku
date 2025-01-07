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
        Schema::create('letter_assignments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kepala_devisi_mer')->nullable();
            $table->string('perihal')->nullable();
            $table->string('nama_acara')->nullable();
            $table->foreignUuid('ttd_markom_id')->nullable()->constrained('signature');
            $table->string('nip_markom')->nullable();
            $table->enum('ttd_digital', ['Ya', 'Tidak'])->default('Tidak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_assignments');
    }
};
