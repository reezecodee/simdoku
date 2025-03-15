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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul')->nullable();
            $table->string('kutipan')->nullable();
            $table->text('kata_pengantar')->nullable();
            $table->text('penutup')->nullable();
            $table->text('press_release')->nullable();
            $table->foreignUuid('ttd_ketua_pelaksana')->nullable()->constrained('signatures');
            $table->foreignUuid('ttd_kadiv_dmer')->nullable()->constrained('signatures');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
