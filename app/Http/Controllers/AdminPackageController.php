<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class AdminPackageController extends Controller
{
    // Display a paginated listing of packages
    public function index()
    {
        // Paginate the packages (e.g., 10 per page)
        $packages = Package::all();
        
        // Pass paginated packages to the view
        return view('admin.dashboard', compact('packages'));
    }

    // Show the form for creating a new package
    public function create()
    {
        return view('admin.packages.create');
    }

    // Store a newly created package in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'package_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_person' => 'required|numeric',
            'starting_date' => 'required|date', // Ensuring it's a valid date
            'ending_date' => 'required|date',   // Ensuring it's a valid date
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'booking_enabled' => 'required|boolean',
            'max_capacity' => 'required|integer|min:1',
        ]);
    
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
        }
    
        // Create a new package
        Package::create([
            'package_name' => $request->package_name,
            'location' => $request->location,
            'description' => $request->description,
            'price_per_person' => $request->price_per_person,
            'starting_date' => $request->starting_date,  // Directly using the request data
            'ending_date' => $request->ending_date,      // Directly using the request data
            'image' => $imagePath,
            'booking_enabled' => $request->booking_enabled,
            'max_capacity' => $request->max_capacity,
        ]);
    
        // Redirect to the packages index with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Package created successfully.');
    }
    


    // Show the form for editing the specified package
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    // Update an existing package
    public function update(Request $request, $id)
    {
        // Find the package by ID
        $package = Package::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'package_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_person' => 'required|numeric',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'booking_enabled' => 'required|boolean',
            'max_capacity' => 'required|integer|min:1',
        ]);

        // Handle image update if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($package->image) {
                $imagePath = trim($package->image);
                if (Storage::disk('public')->exists($imagePath)) {
                    \Log::info('Deleting image: ' . $imagePath);
                    Storage::disk('public')->delete($imagePath);
                }
            }

            // Store the new image and update the package's image path
            $imagePath = $request->file('image')->store('packages', 'public');
            $package->image = $imagePath;
        }

        // Update package data
        $package->update([
            'package_name' => $request->package_name,
            'location' => $request->location,
            'description' => $request->description,
            'price_per_person' => $request->price_per_person,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->ending_date,
            'booking_enabled' => $request->booking_enabled,
        ]);

        // Redirect back to the packages index with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Package updated successfully.');
    }

    // Remove the specified package from storage
    public function destroy($id)
    {
        // Find the package by ID
        $package = Package::findOrFail($id);

        // Delete the image if it exists
        if ($package->image) {
            $imagePath = trim($package->image);
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Delete the package from the database
        $package->delete();

        // Redirect to the packages index with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Package deleted successfully.');
    }
    public function toggleBooking($id)
    {
        $package = Package::findOrFail($id);
        
        // Count the total bookings for the package
        $totalBookings = $package->bookings()->count(); // Assuming there is a relation called bookings
    
        // Check if total bookings have reached max capacity
        if ($totalBookings >= $package->max_capacity) {
            return redirect()->route('admin.dashboard')->with('error', 'Cannot disable booking: package has reached its max capacity.');
        }
    
        // Toggle booking status
        $package->booking_enabled = !$package->booking_enabled; 
        $package->save();
    
        return redirect()->route('admin.dashboard')->with('success', 'Booking status updated successfully.');
    }
    
}

