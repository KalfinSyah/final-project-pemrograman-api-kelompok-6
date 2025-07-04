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
        Schema::create('reservation_vendors', function (Blueprint $table) {
            $table->foreignId('vendor_id')->constrained()->onDelete('restrict');
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');

            $table->primary(['vendor_id', 'reservation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_vendors');
    }
};
