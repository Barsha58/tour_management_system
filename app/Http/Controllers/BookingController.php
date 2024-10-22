<?php

// App\Http\Controllers\BookingController.php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Step 1: Show the customer info form (after clicking Book Now)
    public function showCustomerInfoForm($packageId)
    {
        // Fetch the package details
        $package = Package::findOrFail($packageId);

        // Fetch the authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to make a booking.');
        }

        return view('bookings.customer-info', compact('package', 'user'));
    }

    // Step 2: Store customer info and redirect to the booking confirmation form
    public function storeCustomerInfo(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:15',
            'number_of_people' => 'required|integer|min:1',
            'package_id' => 'required|exists:packages,id',
        ]);

        $package = Package::findOrFail($request->package_id);
        $totalBookings = $package->bookings()->count();

        // Check if booking exceeds max capacity
        if ($totalBookings + $request->number_of_people > $package->max_capacity) {
            return redirect()->back()->with('error', 'Booking exceeds maximum capacity for this package.');
        }

        $totalAmount = $package->price_per_person * $request->number_of_people;

        return redirect()->route('bookings.confirm', [
            'package_id' => $request->package_id,
            'phone' => $request->phone,
            'number_of_people' => $request->number_of_people,
            'total_amount' => $totalAmount,
        ]);
    }

    // Step 3: Show the booking confirmation page
    public function showBookingConfirmationForm(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'phone' => 'required|string|max:15',
            'number_of_people' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $package = Package::findOrFail($request->package_id);
        $user = Auth::user();

        return view('bookings.confirm-booking', [
            'package' => $package,
            'user' => $user,
            'phone' => $request->phone,
            'number_of_people' => $request->number_of_people,
            'total_amount' => $request->total_amount,
        ]);
    }

    // Step 4: Store the booking in the database
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:cash,bkash,credit_card',
            'number_of_people' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to make a booking.');
        }

        $package = Package::findOrFail($request->package_id);
        $totalBookings = $package->bookings()->count();

        // Check if booking exceeds max capacity
        if ($totalBookings + $request->number_of_people > $package->max_capacity) {
            return redirect()->back()->with('error', 'Booking exceeds maximum capacity for this package.');
        }

        Booking::create([
            'user_email' => $user->email,
            'package_id' => $request->package_id,
            'total_persons' => $request->number_of_people,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'booking_status' => 'confirm',
        ]);

        return redirect('/')->with('success', 'Your booking has been confirmed!');
    }

    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->booking_status = 'cancel';
        $booking->save();

        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Booking canceled successfully.');
        } else {
            return redirect()->route('customer.dashboard')->with('success', 'Booking canceled successfully.');
        }
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,completed,failed',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->payment_status = $request->input('payment_status');
        $booking->save();

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }
}
