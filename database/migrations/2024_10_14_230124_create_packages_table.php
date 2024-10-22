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
        Schema::create('packages', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('package_name'); // Name of the package
            $table->string('location'); // Location of the package
            $table->text('description'); // Description of the package
            $table->float('price_per_person', 8, 2); // Price per person (8 digits total, 2 decimal places)
            $table->date('starting_date'); // Starting date of the package
            $table->date('ending_date'); // Ending date of the package
            $table->string('image')->nullable(); // Image of the package (nullable if no image is uploaded)
            $table->boolean('booking_enabled')->default(true); // Whether booking is enabled (default: true)
            $table->timestamps(); // created_at and updated_at columns
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages'); // Drop the packages table
    }
};

