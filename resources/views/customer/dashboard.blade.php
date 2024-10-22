@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    /* Welcome message styling */
    h1 {
        color: #6A1B9A; /* Purple color */
        font-size: 2.5em;
        text-align: center;
        animation: fadeInDown 1s ease-in-out;
        margin-bottom: 40px;
    }

    /* Other heading styles */
    h2 {
        color: #6A1B9A; /* Purple color */
        text-align: center; /* Centered headings */
    }

    /* Label styling */
    label {
        color: #6A1B9A; /* Purple color for labels */
        display: block; /* Display labels as block for better alignment */
        margin-bottom: 5px; /* Space between label and input */
    }

    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Container for sidebar and main content */
    .dashboard-container {
        display: flex;
        max-width: 1400px; /* Increased page width */
        margin: auto;
        gap: 20px;
        padding: 20px; /* Space from header and footer */
    }

    /* Sidebar styling */
    .sidebar {
        width: 250px;
        background-color: #6A1B9A;
        padding: 20px;
        border-radius: 8px;
        color: white;
        position: sticky;
        top: 20px;
        height: fit-content;
    }

    .sidebar button {
        background-color: white;
        color: #6A1B9A;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 100%;
        margin-bottom: 10px;
        text-align: center;
    }

    .sidebar button:hover {
        background-color: #f3e5f5;
    }

    /* Main content (center) */
    .main-content {
        flex-grow: 1;
        background-color: transparent; /* Ensures it doesn't show a white background */
        padding: 20px;
        border-radius: 8px; /* Rounded corners for main content */
        border: 2px solid transparent; /* Transparent border for the container */
    }

    /* Form styling */
    form {
        background-color: #ffffff; /* White background for forms */
        padding: 20px; /* Margin color in form */
        border-radius: 8px; /* Rounded corners for form */
        border: 2px solid #6A1B9A; /* Purple border color for the form */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for form */
        margin-top: 20px; /* Space above the form */
    }

    /* Input styling */
    input[type="text"], input[type="email"], input[type="password"] {
        width: 100%; /* Full width */
        padding: 10px; /* Padding for input boxes */
        border: 1px solid #ddd; /* Border for input boxes */
        border-radius: 4px; /* Rounded corners for input boxes */
        margin-bottom: 15px; /* Space between input fields */
    }

    /* Button styling */
    button[type="submit"] {
        background-color: #6A1B9A; /* Purple button color */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 100%; /* Full width button */
    }

    button[type="submit"]:hover {
        background-color: #3F51B5; /* Blue on hover */
    }

    /* Table styling */

    /* Add this to your CSS */
    table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* Added to keep the layout stable */
    border: 2px solid #6A1B9A;
    margin-top: 10px;
}


th, td {
    padding: 10px;
    border: 1px solid #ddd;
    horizontal-align: middle; /* Aligns the button vertically in the middle of the cell */
}

/* Button styling */
button.btn {
    margin: 0; /* Removes any margin */
    padding: 5px 10px; /* Adjust padding as needed */
    display: inline-block; /* Ensures it doesn't stretch the table cell */
    vertical-align: middle; /* Aligns the button with text in the cell */
}




    th {
        background-color:#6A1B9A ;
        color: white;
    }

    td {
        color: #6A1B9A;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    /* Hidden sections (initially hidden) */
    #passwordFormSection, #profileFormSection, #bookingsSection {
        display: none; /* Hide by default */
        margin-top: 20px;
    }
</style>

<main>
    <h1>Welcome, {{ Auth::user()->name }}</h1>

    <!-- Dashboard structure -->
    <div class="dashboard-container">
        <!-- Sidebar for profile and password -->
        <div class="sidebar">
            <button class="toggle-button" id="togglePasswordForm">Change Password</button>
            <button class="toggle-button" id="toggleProfileForm">Update Profile</button>
            <button class="toggle-button" id="toggleBookings">View Bookings</button>
        </div>

        <!-- Main content - Toggled Forms and Bookings Section -->
        <div class="main-content">
            <!-- Change Password Form -->
            <div id="passwordFormSection">
    <h2>Change Password</h2>
    <form action="{{ route('password.change') }}" method="POST">
        @csrf
        <div>
            <label for="old_password">Old Password:</label>
            <input type="password" name="old_password" id="old_password" placeholder="Enter your old password" required>
        </div>
        <div>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" placeholder="Enter your new password" required>
        </div>
        <div>
            <label for="new_password_confirmation">Confirm New Password:</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Re-enter your new password" required>
        </div>
        <button type="submit">Update Password</button>
    </form>
</div>



            <!-- Update Profile Form -->
            <div id="profileFormSection">
                <h2>Update Profile</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <button type="submit">Update Profile</button>
                </form>
            </div>

            <!-- Bookings Section -->
            <div id="bookingsSection">
                <h2>Your Booked Packages</h2>
                @if ($bookings->isEmpty())
                    <p>You have no bookings yet.</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Package Name</th>
                                <th>Description</th>
                                <th>Booking Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->package->package_name }}</td>
                                    <td>{{ $booking->package->description }}</td>
                                    <td>{{ ucfirst($booking->booking_status) }}</td>
                                    <td>
    @if ($booking->booking_status !== 'cancel')
        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Cancel Booking</button>
        </form>
    @else
        <span class="text-muted">This booking is canceled.</span>
    @endif
</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</main>

<script>
    // Toggle for Change Password section
    document.getElementById('togglePasswordForm').addEventListener('click', function() {
        toggleSection('passwordFormSection');
    });

    // Toggle for Update Profile section
    document.getElementById('toggleProfileForm').addEventListener('click', function() {
        toggleSection('profileFormSection');
    });

    // Toggle for Bookings section
    document.getElementById('toggleBookings').addEventListener('click', function() {
        toggleSection('bookingsSection');
    });

    // Generic function to toggle visibility of a section
    function toggleSection(sectionId) {
        var section = document.getElementById(sectionId);
        if (section.style.display === "none" || section.style.display === "") {
            section.style.display = "block";
        } else {
            section.style.display = "none";
        }
    }
</script>
@endsection
