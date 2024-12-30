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
            $table->text('penutup')->nullable();
            $table->foreignUuid('ttd_ketua_pelaksana')->nullable()->constrained('signature');
            $table->foreignUuid('ttd_kadiv_dmer')->nullable()->constrained('signature');
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
