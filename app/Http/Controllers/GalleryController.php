<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryImage; // Assuming the model is called GalleryImage
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Method to display all gallery images
    public function index()
    {
        $images = GalleryImage::all(); // Fetch all gallery images
        return view('admin.dashboard', compact('images'));
    }

    // Method to add a new gallery image
    public function create()
    {
        return view('admin.gallery.create');
    }

    // Method to store the uploaded gallery image
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination' => 'required|string|max:255', // Ensure you validate destination as well
        ]);

        // Store the image in the public directory under 'gallery'
        $imagePath = $request->file('image')->store('gallery', 'public');

        // Create a new gallery image record
        $gallery = new GalleryImage(); // Assuming the model is GalleryImage
        $gallery->image_path = $imagePath;
        $gallery->destination = $request->destination; // Save the destination
        $gallery->save();

        return redirect()->route('admin.dashboard')->with('success', 'Image added successfully.');
    }

    // Method to show the edit form for a gallery image
    public function edit($id)
    {
        $gallery = GalleryImage::findOrFail($id); // Fetch the image by ID
        return view('admin.gallery.edit', compact('gallery')); // Pass it to the edit view
    }

    // Method to update the gallery image
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination' => 'required|string|max:255', // Validate destination
        ]);

        $gallery = GalleryImage::findOrFail($id); // Find the image by ID

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image from storage
            Storage::disk('public')->delete($gallery->image_path);
            
            // Store the new image
            $imagePath = $request->file('image')->store('gallery', 'public');
            $gallery->image_path = $imagePath; // Update the image path
        }

        // Update the destination
        $gallery->destination = $request->destination; 
        $gallery->save(); // Save the changes

        return redirect()->route('admin.dashboard')->with('success', 'Image updated successfully.');
    }

    // Method to delete a gallery image
    public function destroy($id)
    {
        $gallery = GalleryImage::findOrFail($id);
        Storage::disk('public')->delete($gallery->image_path); // Delete image from storage
        $gallery->delete(); // Delete record from database

        return redirect()->route('admin.dashboard')->with('success', 'Image deleted successfully.');
    }
}
