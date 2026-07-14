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
    Schema::create('detail_servis', function (Blueprint $table) {
        $table->id(); // PK
        // FK ke servis_pendaftarans dan mekaniks
        $table->foreignId('servis_pendaftaran_id')->constrained('servis_pendaftarans')->onDelete('cascade');
        $table->foreignId('mekanik_id')->constrained('mekaniks')->onDelete('cascade');
        $table->text('keluhan_kerusakan');
        $table->integer('biaya_jasa')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_servis');
    }
};
