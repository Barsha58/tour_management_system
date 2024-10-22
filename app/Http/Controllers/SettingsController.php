<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // Fetching the first instance of contact and about us information
        $contact = Contact::first();
        $aboutUs = AboutUs::first();

        return view('admin.settings.index', compact('contact', 'aboutUs'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $contact = Contact::first();
        if ($contact) {
            $contact->update($request->all());
        } else {
            Contact::create($request->all());
        }

        return redirect()->route('settings.index')->with('success', 'Contact information updated successfully.');
    }

    public function deleteContact()
    {
        $contact = Contact::first();
        if ($contact) {
            $contact->delete();
        }

        return redirect()->route('settings.index')->with('success', 'Contact information deleted successfully.');
    }

    
}
