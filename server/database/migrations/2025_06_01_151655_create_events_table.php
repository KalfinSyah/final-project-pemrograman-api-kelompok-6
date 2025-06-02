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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_rundown_id')->constrained('wedding_rundowns')->onDelete('cascade');
            $table->integer('event_order');
            $table->string('event_time', 50);
            $table->text('event_description');
            $table->string('event_remark', 255);
            $table->string('event_pic', 100);
            $table->string('event_venue', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
