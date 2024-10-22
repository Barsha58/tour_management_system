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
            $table->string('user_email'); // Store user email
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade'); // Foreign key to packages table
            $table->integer('total_persons'); // Total number of people
            $table->decimal('total_amount', 10, 2); // Total booking amount
            $table->enum('payment_method', ['cash', 'bkash', 'credit_card']); // Payment method
            $table->string('payment_status')->default('pending'); // Payment status
            $table->enum('booking_status', ['confirm', 'cancel'])->default('confirm'); // Booking status
            $table->timestamps();

            // Foreign key constraint for user_email
            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
