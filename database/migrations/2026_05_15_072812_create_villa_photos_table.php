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
    Schema::create('villa_photos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('villa_id')->constrained('villas')->onDelete('cascade');
        $table->string('keterangan')->nullable();
        $table->string('foto');
        $table->boolean('status')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villa_photos');
    }
};
