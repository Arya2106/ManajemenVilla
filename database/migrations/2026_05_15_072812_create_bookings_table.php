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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
        $table->foreignId('villa_id')->constrained('villas')->onDelete('cascade');
        $table->dateTime('tanggal_checkin');
        $table->dateTime('tanggal_checkout');
        $table->string('status');
        $table->string('catatan')->nullable();
        $table->bigInteger('jumlah_tamu');
        $table->bigInteger('total_harga');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
