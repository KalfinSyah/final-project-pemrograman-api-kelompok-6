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
        Schema::create('calenders', function (Blueprint $table) {
            $table->id();
            $table->enum('calender_name', ['Reservasi Lokasi', 'Pemesanan Katering', 'Koordinasi Staff', 'Pelaksanaan Acara'])->default('Pelaksanaan Acara');
            $table->date('calender_date');
            $table->enum('calender_status', ['Selesai', 'Pending', 'Batal', 'Mundur'])->default('Pending');
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calenders');
    }
};
