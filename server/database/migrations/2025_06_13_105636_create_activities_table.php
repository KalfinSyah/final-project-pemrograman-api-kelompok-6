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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->enum('activity_type', ['Reservasi Lokasi', 'Pemesanan Katering', 'Koordinasi Staff', 'Pelaksanaan Acara'])->default('Pelaksanaan Acara');
            $table->string('activity_name', 100);
            $table->date('activity_date');
            $table->text('activity_desc');
            $table->enum('activity_status', ['Pending', 'Selesai', 'Batal'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
