<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages'; // Specify the table name if it doesn't follow Laravel's naming convention

    protected $fillable = [
        'package_name',
        'location',
        'description',
        'price_per_person',
        'starting_date',
        'ending_date',
        'image', // Add image
        'booking_enabled',
        'max_capacity', // Add booking status
    ];

    /**
     * Define a one-to-many relationship with the Booking model.
     * 
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Accessor to get the count of bookings for this package.
     * 
     * @return int
     */
    public function getBookingsCountAttribute(): int
    {
        return $this->bookings()->count();
    }

    /**
     * Accessor to determine if booking is enabled based on max capacity.
     * 
     * @return bool
     */
    public function getBookingEnabledAttribute(): bool
    {
        return $this->bookings_count < $this->max_capacity; // Check if current bookings are less than max capacity
    }

    // Add any additional model methods or custom queries as needed
}
