@extends('layouts.admin')

@section('content')
    <div class="container mt-5 admin-package-form">
        <h1 class="text-center mb-4 animated-heading">Create Package<span class="underline"></span></h1>

        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="package_name" class="form-label">Package Name</label>
                <input type="text" class="form-control" id="package_name" name="package_name" placeholder="Enter package name" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter package description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="price_per_person" class="form-label">Price per Person</label>
                <input type="number" class="form-control" id="price_per_person" name="price_per_person" placeholder="Enter price per person" required>
            </div>

            <div class="mb-3 position-relative">
                <label for="starting_date" class="form-label">Starting Date (DD/MM/YYYY)</label>
                <input type="date" class="form-control" id="starting_date" name="starting_date" required>
            </div>

            <div class="mb-3 position-relative">
                <label for="ending_date" class="form-label">Ending Date (DD/MM/YYYY)</label>
                <input type="date" class="form-control" id="ending_date" name="ending_date" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Package Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="mb-3">
                <label for="booking_enabled" class="form-label">Enable Booking</label>
                <select class="form-select" id="booking_enabled" name="booking_enabled" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="max_capacity" class="form-label">Max Capacity</label>
                <input type="number" class="form-control" id="max_capacity" name="max_capacity" placeholder="Enter max capacity" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 submit-btn">Create Package</button>
        </form>
    </div>
@endsection

@section('styles')
    <style>
        /* General Form Styling */
        .admin-package-form .form-control,
        .admin-package-form .form-select {
            border-radius: 0.5rem; /* Rounded corners */
            color: purple; /* Text color for input fields */
        }

        .admin-package-form .form-label {
            font-weight: 600; /* Bold labels */
            color: purple !important; /* Changed text color to purple */
        }

        /* Submit button animations */
        .submit-btn {
            background-color: #007bff; /* Primary button color */
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transitions */
            color: white; /* Button text color */
        }

        .submit-btn:hover {
            background-color: #0056b3; /* Darker on hover */
            transform: scale(1.05); /* Slight zoom-in effect */
        }

        /* Heading animations */
        .animated-heading {
            font-size: 2.5rem;
            color: purple; /* Changed heading color to purple */
            position: relative; /* Position relative to allow absolute positioning of the underline */
            display: inline-block; /* Required for the underline effect */
            transition: color 0.3s ease; /* Transition effect on color change */
        }

        .animated-heading:hover {
            color: darkpurple; /* Darker shade on hover */
        }

        /* Underline effect */
        .underline {
            content: "";
            display: block;
            width: 100%;
            height: 4px; /* Thickness of the underline */
            background-color: #007bff; /* Color of the underline */
            transform: scaleX(0); /* Initially hidden */
            transition: transform 0.3s ease; /* Smooth scaling transition */
            position: absolute; /* Positioned absolutely within the heading */
            bottom: -10px; /* Positioning below the text */
            left: 0;
        }

        .animated-heading:hover .underline {
            transform: scaleX(1) !important; /* Scale the underline to full width on hover */
        }

        /* Calendar Icon Styling */
        .calendar-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 1.2rem;
        }

        /* Date input field animation */
        .admin-package-form input[type="date"] {
            transition: border-color 0.3s ease;
        }

        .admin-package-form input[type="date"]:hover {
            border-color: #007bff;
        }

        .admin-package-form input[type="date"]:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
        }

        /* Container styling */
        .admin-package-form .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
    </style>
@endsection
