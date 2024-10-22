<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Booking;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Fetch the user's booked packages, excluding canceled ones
        $bookings = Booking::with('package') // Ensure that 'package' relationship is defined in the Booking model
            ->where('user_email', $user->email) // Use 'user_email' for filtering bookings
            ->where('booking_status', '!=', 'cancel') // Exclude canceled bookings
            ->get();

        // Pass user and bookings to the view
        return view('customer.dashboard', compact('user', 'bookings'));
    }
    public function updateProfile(Request $request)
{
    // Validate the input data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . Auth::id(), // Unique email, but allow current user’s email
    ]);

    // Get the authenticated user
    $user = Auth::user();

    // Update user's name and email
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save();

    // Redirect back to the dashboard with a success message
    return redirect()->route('customer.dashboard')->with('success', 'Profile updated successfully.');
}

}



