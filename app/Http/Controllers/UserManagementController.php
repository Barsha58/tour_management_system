<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        // Fetch users based on their roles
        $admins = User::where('role', 'admin')->get();
        $customers = User::where('role', 'customer')->get();

        return view('admin.users.index', compact('admins', 'customers'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->input('role'); // Update the role
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Delete the user

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function create()
    {
        return view('admin.users.create'); // Create a new view for this
    }

    // Method to store the new user
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure email is unique
            'password' => 'required|string|min:8|confirmed', // Ensure password confirmation
            'role' => 'required|string|in:admin,customer', // Role should be either admin or customer
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Hash the password before saving
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Method to show the update form for user name and email
    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user to edit
        return view('admin.users.edit', compact('user')); // Return view with user data
    }

    // Method to update user name and email
    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ensure email is unique, ignoring the current user's email
        ]);

        $user = User::findOrFail($id); // Fetch the user
        $user->name = $request->input('name'); // Update the name
        $user->email = $request->input('email'); // Update the email
        $user->save(); // Save changes

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
