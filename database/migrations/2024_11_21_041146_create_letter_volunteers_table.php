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
        Schema::create('letter_volunteers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('letter_id')->constrained('letter_assignments');
            $table->string('nim')->nullable();
            $table->string('nama')->nullable();
            $table->string('sekolah')->nullable();
            $table->string('tgl_pelaksanaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_volunteers');
    }
};
