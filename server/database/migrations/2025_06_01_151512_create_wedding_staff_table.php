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
        Schema::create('wedding_staffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marriage_contract_staff_id')->constrained('marriage_contract_staffs')->onDelete('cascade');
            $table->foreignId('reception_staff_id')->constrained('reception_staffs')->onDelete('cascade');
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_staffs');
    }
};
