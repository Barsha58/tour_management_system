<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Package;
use App\Models\Booking;
use App\Models\GalleryImage; // Assuming you have a Gallery model
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Check if the authenticated user is an admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Fetch total admins and customers
            $totalAdmins = User::where('role', 'admin')->count();
            $totalCustomers = User::where('role', 'customer')->count();
            
            // Fetch total packages, bookings, gallery images, and revenue
            $totalPackages = Package::count();
            $totalBookings = Booking::count();
            $totalGalleryImages = GalleryImage::count(); 
            $totalRevenue = Booking::where('booking_status', 'confirm')->sum('total_amount'); // Adjusting to 'booking_status'

            // Fetch packages and bookings for the dashboard
            $packages = Package::all(); // Pagination for packages
            $bookings = Booking::with(['user', 'package'])->get();
            $images = GalleryImage::all();
            // Fetch only 6 gallery images
            $packages = Package::withCount('bookings')->get();

            return view('admin.dashboard', compact(
                'totalAdmins', 
                'totalCustomers', 
                'totalPackages', 
                'totalBookings', 
                'totalGalleryImages', 
                'totalRevenue', // Correct variable name
                'packages', 
                'bookings', 
                'images' // Pass the 6 images to the view
            ));
        }

        // Redirect or show error if not an admin
        return redirect()->route('home')->with('error', 'Unauthorized access.');
    }

    // Function to cancel a booking
    public function cancelBooking($id)
    {
        // Find the booking by ID or fail if it doesn't exist
        $booking = Booking::findOrFail($id);
        
        // Update booking status to 'cancel'
        $booking->booking_status = 'cancel';
        $booking->save();

        // Redirect to the admin dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Booking canceled successfully.');
    }
}
