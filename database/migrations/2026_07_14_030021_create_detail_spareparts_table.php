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
    Schema::create('detail_spareparts', function (Blueprint $table) {
        $table->id(); // PK
        // FK ke detail_servis dan spareparts
        $table->foreignId('detail_servis_id')->constrained('detail_servis')->onDelete('cascade');
        $table->foreignId('sparepart_id')->constrained('spareparts')->onDelete('cascade');
        $table->integer('jumlah');
        $table->integer('subtotal_harga');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_spareparts');
    }
};
