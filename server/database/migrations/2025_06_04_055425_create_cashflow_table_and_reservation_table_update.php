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
        Schema::create('cashflows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->enum('cashflow_type', ['Pendapatan', 'Pengeluaran'])->default('Pengeluaran');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'progress',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashflows');

        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('progress');
        });
    }
};
