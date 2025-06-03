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
        Schema::table('wedding_staffs', function (Blueprint $table) {
            $table->dropColumn([
                'marriage_contract_staff_id',
                'reception_staff_id'
            ]);
        });

        Schema::dropIfExists('reception_staffs');
        Schema::dropIfExists('marriage_contract_staffs');

        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_staff_id')->constrained('wedding_staffs')->onDelete('cascade');
            $table->string('staff_name', 255);
            $table->enum('staff_type', ['Petugas Resepsi', 'Petugas Akad Nikah'])->default('Pelaksanaan Acara');
            $table->string('jobdesk', 100);
            $table->string('description', 100);
            $table->string('handphone_num', 15);
            $table->string('pic', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');

        Schema::create('reception_staffs', function (Blueprint $table) {
            $table->id();
            $table->string('staff_name', 255);
            $table->string('jobdesk', 100);
            $table->string('handphone_num', 15);
            $table->timestamps();
        });

        Schema::create('marriage_contract_staffs', function (Blueprint $table) {
            $table->id();
            $table->string('staff_name', 255);
            $table->string('description', 255);
            $table->string('handphone_num', 15);
            $table->string('pic', 50);
            $table->timestamps();
        });

        Schema::tabke('wedding_staffs', function (Blueprint $table) {
            $table->foreignId('marriage_contract_staff_id')->constrained('marriage_contract_staffs')->onDelete('cascade');
            $table->foreignId('reception_staff_id')->constrained('reception_staffs')->onDelete('cascade');
        });
    }
};
