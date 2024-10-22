<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'user_email', // Store user email
        'package_id', // Foreign key to packages table
        'total_persons', // Total number of persons in the booking
        'total_amount', // Total amount for the booking
        'payment_method', // Method of payment
        'payment_status', // Status of the payment (pending, completed, etc.)
        'booking_status', // Status of the booking (confirm, cancel)
    ];

    // Define relationships
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Define relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email'); // Correctly relate using user_email to email
    }
}

