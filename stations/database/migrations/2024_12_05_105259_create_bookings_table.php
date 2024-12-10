<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_id');       // Foreign key for slot
            $table->unsignedBigInteger('car_id');        // Foreign key for car
            $table->string('car_no');                    // Car number (entered by user)
            $table->integer('units');                    // Number of units
            $table->decimal('total_price', 10, 2);       // Total price (calculated)
            $table->string('status')->default('pending'); // Booking status
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('slot_id')->references('id')->on('slots')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
