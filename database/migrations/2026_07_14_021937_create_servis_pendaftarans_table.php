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
    Schema::create('servis_pendaftarans', function (Blueprint $table) {
        $table->id(); // PK
        // FK ke kendaraans
        $table->foreignId('kendaraan_id')->constrained('kendaraans')->onDelete('cascade');
        $table->date('tanggal_servis');
        $table->enum('status_servis', ['Antri', 'Dikerjakan', 'Selesai', 'Dibatalkan'])->default('Antri');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis_pendaftarans');
    }
};