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
    Schema::create('pembayarans', function (Blueprint $table) {
        $table->id(); // PK
        // FK ke servis_pendaftarans
        $table->foreignId('servis_pendaftaran_id')->constrained('servis_pendaftarans')->onDelete('cascade');
        $table->date('tanggal_bayar');
        $table->integer('total_bayar');
        $table->string('metode_pembayaran', 30)->default('Tunai'); // Tunai/Transfer/Qris
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
