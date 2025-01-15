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
        Schema::create('executions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('surat_tugas_id')->constrained('letter_assignments')->cascadeOnDelete();
            $table->string('nama_sekolah')->nullable();
            $table->string('tgl_pelaksanaan')->nullable();
            $table->enum('type', ['Staff', 'Volunteer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('executions');
    }
};
