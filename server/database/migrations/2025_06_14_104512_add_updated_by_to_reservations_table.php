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
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict');
        });
        Schema::table('activities', function (Blueprint $table) {
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict');
        });
        Schema::table('cashflows', function (Blueprint $table) {
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'updated_by'
            ]);
        });
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn([
                'updated_by'
            ]);
        });
        Schema::table('cashflows', function (Blueprint $table) {
            $table->dropColumn([
                'updated_by'
            ]);
        });
    }
};
