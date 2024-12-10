<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('station_id');  // Link to EV stations
            $table->timestamp('start_time')->nullable();  // Slot's start time (use timestamp)
            $table->timestamp('end_time')->nullable();    // Slot's end time (use timestamp)
            $table->enum('status', ['available', 'booked'])->default('available');  // Slot status
            $table->timestamps();  // Created at & updated at

            $table->foreign('station_id')->references('id')->on('ev_stations')->onDelete('cascade');  // Foreign key relation
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
