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
        Schema::create('proposal_plan_committees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('proposal_id')->constrained('proposals');
            $table->string('nama')->nullable();
            $table->enum('peran', ['Pelindung', 'Penanggung jawab', 'Ketua pelaksana', 'Sekertaris', 'Bendahara', 'Seksi acara', 'Divisi humas', 'Seksi pudekdok', 'Koordinator lapangan'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_plan_committees');
    }
};
