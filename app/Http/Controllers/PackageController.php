<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\GalleryImage; // Assuming you have a Gallery model
use App\Models\AboutUs; // Assuming you have an AboutUs model
use App\Models\Contact; // Assuming you have a Contact model

class PackageController extends Controller
{
    // Show Home Page with available packages
    public function index()
    {
        $packages = Package::paginate(10); // Paginate results
        $locations = Package::distinct()->pluck('location'); // Get distinct locations

        // Fetch additional data
        $gallery = GalleryImage::all(); // Fetch all gallery images
        $aboutUs = AboutUs::first(); // Get the first entry for about us
        $contact = Contact::first(); // Get the first entry for contact info

        return view('packages.index', compact('packages', 'locations', 'gallery', 'aboutUs', 'contact'));
    }
    public function searchPackages(Request $request)
    {
        // Get user input
        $destination = $request->input('destination');
        $selected_month = $request->input('selected_month');
    
        // Validate the inputs
        $request->validate([
            'destination' => 'required|string',
            'selected_month' => 'required|date_format:Y-m',
        ], [
            'destination.required' => 'Please enter a destination.',
            'selected_month.required' => 'Please select a month.',
            'selected_month.date_format' => 'The selected month must be in the format YYYY-MM.',
        ]);
    
        // Fetch packages based on location and month
        $packages = Package::where('location', $destination)
            ->whereMonth('starting_date', date('m', strtotime($selected_month)))
            ->where('booking_enabled', true) 
            ->get();
    
        // Prepare a message for the view
        $message = '';
    
        // Check if packages were found
        if ($packages->isEmpty()) {
            // Additional query to check if any packages exist for the entered destination
            $anyPackagesForDestination = Package::where('location', $destination)->exists();
    
            if ($anyPackagesForDestination) {
                $message = 'No available packages found for this month in the selected location.';
            } else {
                $message = 'No packages found for the entered destination.';
            }
        }
    
        return view('packages.search-results', compact('packages', 'message'));
    }
    
}
