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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->string('combined_name', 255);
            $table->string('groom', 255);
            $table->string('bride', 255);
            $table->string('telephone_num', 255);
            $table->string('wedding_location', 255)->nullable();
            $table->text('wedding_contract_notes');
            $table->text('reception_notes');
            $table->decimal('cashflow_in', 15, 2)->nullable();
            $table->decimal('cashflow_out', 15, 2)->nullable();
            $table->enum('wedding_package', ['A', 'B', 'C', 'D', 'E'])->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
