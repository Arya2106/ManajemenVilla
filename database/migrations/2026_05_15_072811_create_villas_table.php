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
    Schema::create('villas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->bigInteger('kapasitas');
        $table->integer('jumlah_kamar');
        $table->bigInteger('harga_permalam');
        $table->string('status');
        $table->string('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villas');
    }
};
