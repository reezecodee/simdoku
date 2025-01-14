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
        Schema::create('signatures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pemilik');
            $table->string('nip');
            $table->string('tanda_tangan');
            $table->enum('status', ['Kadiv DMER', 'Koordinator Markom', 'KA. Divisi MER', 'KA. BAKU', 'Ketua Panitia', 'Ketua Pelaksana']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
