<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') | TravelXplorer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flaticon/2.1.0/font/flaticon.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">



    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
       body {
    font-family: 'Arial', sans-serif;
    background-color: #E5F3FD;
    padding-left: 250px; /* Add padding for sidebar */
}

.sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #6F1D99; /* Purple background */
    padding-top: 20px;
    transition: all 0.3s ease;
}

.logo {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 30px;
    color: white;
    font-size: 22px;
    font-weight: bold;
}

.logo i {
    margin-right: 10px;
    font-size: 28px; /* Adjust icon size */
}

.sidebar .nav-item {
    margin: 15px 0;
}

.sidebar .nav-link {
    color: white;
    padding: 10px 20px;
    display: block;
    font-size: 18px;
    font-weight: bold;
    transition: background-color 0.3s, padding-left 0.3s;
}

.sidebar .nav-link:hover {
    background-color: #5b27a7; /* Darker purple on hover */
    padding-left: 30px;
}

.sidebar .nav-link.active {
    background-color: #4a1e85; /* Active link style */
}

/* CSS for animation */
.fadeInUp {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 1s ease-in-out forwards;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animated-card {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    transition: transform 0.3s, background-color 0.3s; /* Smooth transition for hover */
    padding: 20px; /* Added padding to cards */
}

/* Card styles */
.bg-light-purple {
    background-color: #6f42c1; /* Dark purple */; /* Light purple */
}

.bg-purple {
    background-color: #8e44ad; /* Standard purple */
}

.bg-dark-purple {
    background-color: #6f42c1; /* Dark purple */
}

.bg-lighter-purple {
    background-color:  #8e44ad; /* Lighter purple */
}

.bg-deep-purple {
    background-color: #6f42c1; /* Dark purple *; /* Deep purple */
}

.bg-purple-darker {
    background-color:  #8e44ad; /* Darker purple */
}

/* Hover effects */
.card:hover {
    transform: translateY(-5px); /* Moves card up slightly */
    background-color: #7a3eab; /* Change to a different purple shade on hover */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
}

.card-text {
    color: white; /* Ensure text is white */
}

/* Welcome message styles */
#content {
    text-align: center;
    margin-top: 20px;
    padding: 20px; /* Added padding to the welcome message */
}

h1 {
    font-weight: bold;
    color: purple;
    padding-bottom: 20px; /* Added padding below heading */
}


#package-management {
    background-color: #f8f9fa; /* Light background for contrast */
    padding: 30px; /* Padding around the section */
    margin: 20px 0; /* Margin for spacing above and below the section */
    border: 2px solid #6f42c1; /* Purple border */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    transition: transform 0.3s; /* Smooth scaling effect */
}

#package-management:hover {
    transform: scale(1.02); /* Slightly enlarge on hover */
}

h2 {
    color: #6f42c1; /* Purple color for the heading */
    margin-bottom: 20px; /* Space below heading */
    font-weight: bold; /* Make the heading bold */
    animation: fadeInDown 0.5s ease-in-out; /* Animation for the heading */
}


.table {
    border-collapse: separate; /* Allows for spacing between table cells */
    border-spacing: 0 10px; /* Space between table rows */
}

.table th, .table td {
    background-color: #ffffff; /* White background for cells */
    border-radius: 5px; /* Rounded corners for table cells */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow for depth */
    transition: background-color 0.3s; /* Smooth transition for hover */
}

.table th {
    background-color: #6f42c1; /* Purple background for headers */
    color: white; /* White text for headers */
}

.table tbody tr:hover td {
    background-color: #d1c4e9; /* Light purple on row hover */
}

.table img {
    border-radius: 5px; /* Rounded corners for images */
}

/* Keyframes for heading animation */
@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.create-package-btn {
    background-color: #0000cc; /* Purple color for the button */
    color: white; /* White text */
    padding: 10px 20px; /* Padding around the text */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners */
    font-weight: bold; /* Bold text */
    text-decoration: none; /* Remove underline */
    transition: background-color 0.3s, transform 0.3s; /* Smooth transition for background color and scale */
}

.create-package-btn:hover {
    background-color: #007bff; /* Change to blue on hover */
    transform: scale(1.05); /* Slightly enlarge on hover */
}

/* In your CSS file or within a <style> tag */
.img-small {
    max-width: 50px; /* Maximum width */
    max-height: 50px; /* Maximum height */
    width: auto; /* Automatic width */
    height: auto; /* Automatic height */
}



#booking-management {
    background-color: #f8f9fa; /* Light background for contrast */
    padding: 30px; /* Padding around the section */
    margin: 20px 0; /* Margin for spacing above and below the section */
    border: 2px solid #6f42c1; /* Purple border */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    animation: fadeIn 0.5s ease-in-out; /* Fade-in animation for the section */
}

.table {
    border-collapse: separate; /* Allows for spacing between table cells */
    border-spacing: 0 10px; /* Space between table rows */
}

.table th, .table td {
    background-color: #ffffff; /* White background for cells */
    border-radius: 5px; /* Rounded corners for table cells */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow for depth */
    transition: background-color 0.3s, transform 0.3s; /* Smooth transition for hover and scale */
}

.table th {
    background-color: #6f42c1; /* Purple background for headers */
    color: white; /* White text for headers */
}

.table tbody tr {
    transition: transform 0.3s; /* Smooth transition for row hover */
}

.table tbody tr:hover {
    transform: scale(1.02); /* Slightly enlarge row on hover */
    background-color: #d1c4e9; /* Light purple on row hover */
}

.table img {
    border-radius: 5px; /* Rounded corners for images */
}
#booking-management h2 {
    text-align: center; /* Center the text */
    color: #6f42c1; /* Optional: Purple color for the heading */
    margin-bottom: 20px; /* Space below the heading */
}


/* Keyframes for section fade-in animation */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}


#gallery-section {
    background-color: #f8f9fa; /* Light background for contrast */
    padding: 30px; /* Padding around the section */
    margin: 20px 0; /* Margin for spacing above and below the section */
    border: 2px solid #6f42c1; /* Purple border */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    animation: fadeIn 0.5s ease-in-out; /* Fade-in animation for the section */
}

#gallery-section .row {
    display: flex; /* Use flexbox for layout */
    flex-wrap: wrap; /* Allow wrapping to the next line */
}

#gallery-section .col-md-4 {
    flex: 1 0 30%; /* Flex-grow: 1, Flex-shrink: 0, Flex-basis: 30% */
    display: flex; /* Use flex to center content */
    align-items: stretch; /* Make items stretch to equal height */
    justify-content: center; /* Center content horizontally */
    margin-bottom: 20px; /* Space between cards */
}

#gallery-section .card {
    width: 100%; /* Make the card take full width of the column */
    height: 300px; /* Set a fixed height for the cards */
    display: flex; /* Flexbox for the card content */
    flex-direction: column; /* Stack children vertically */
    transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for card hover */
}

#gallery-section .card img {
    height: 200px; /* Fixed height for images */
    object-fit: cover; /* Cover to maintain aspect ratio */
    border-top-left-radius: 10px; /* Rounded corners for the top of the card */
    border-top-right-radius: 10px; /* Rounded corners for the top of the card */
}

#gallery-section .card-body {
    display: flex; /* Use flexbox for card body */
    flex-direction: column; /* Stack items vertically */
    justify-content: space-between; /* Space out elements */
    height: calc(100% - 200px); /* Adjust height based on image size */
}

#gallery-section .card-title {
    color: #6f42c1; /* Purple color for card titles */
    transition: color 0.3s; /* Smooth transition for title color */
}

#gallery-section .card-title:hover {
    color: #5a2c91; /* Darker purple on hover */
}
#gallery-section .btn-add-new {
    background-color: ##0000cc; /* Blue background */
    color: #fff; /* White text */
    border: none; /* Remove border */
    padding: 0.5rem 1rem; /* Padding for button size */
    font-size: 1rem; /* Font size for the button text */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s ease; /* Smooth transition */
}

#gallery-section .btn-add-new:hover {
    background-color: #0056b3; /* Darker blue on hover */
    color: #fff; /* Ensure white text remains on hover */
}

/* Button Styles */
.btn-small {
    padding: 0.25rem 0.5rem; /* Smaller padding */
    font-size: 0.75rem; /* Smaller font size */
    border-radius: 5px; /* Slightly rounded corners */
    min-width: 70px; /* Minimum width for consistency */
    height: 30px; /* Fixed height for consistency */
    line-height: 1; /* Ensure button text is vertically centered */
    text-align: center; /* Center text */
    display: inline-flex; /* Flexbox for centering */
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
}

.btn-small:hover {
    background-color: #ffc107; /* Change color on hover */
    color: #fff; /* Change text color on hover */
}

#gallery-section h2 {
    text-align: center; /* Center the text */
    color: #6f42c1; /* Optional: Purple color for the heading */
    margin-bottom: 20px; /* Space below the heading */
}

/* Keyframes for section fade-in animation */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.footer {
    background-color: white; /* Purple background color */
    color: #ffffff; /* White text color */
    padding: 20px 0; /* Padding for the footer */
    text-align: center; /* Center the text */
    transition: background-color 0.3s; /* Smooth transition for background color */
}

.footer:hover {
    background-color: #4a0e5b; /* Darker shade on hover */
}

.footer span {
    font-weight: bold; /* Make text bold */
    font-size: 1.2rem; /* Slightly increase font size */
    animation: fadeIn 0.5s; /* Animation for text appearance */
}

/* Keyframes for fade-in animation */
@keyframes fadeIn {
    from {
        opacity: 0; /* Start invisible */
    }
    to {
        opacity: 1; /* Fade to visible */
    }
}

/* Optional: Add hover effect for better interactivity */
.footer a {
    color: #ffffff; /* White color for links */
    text-decoration: none; /* Remove underline from links */
    transition: color 0.3s; /* Smooth color transition */
}

.footer a:hover {
    color: #E5F3FD; /* Change link color on hover */
}

/* Dropdown Link Styles */
.x-dropdown-link {
    display: block; /* Block display for links */
    padding: 10px 15px; /* Padding for links */
    color: #ffffff; /* Text color for links (white) */
    background-color: #007bff; /* Initial blue background */
    text-decoration: none; /* Remove underline */
    transition: background-color 0.3s, color 0.3s; /* Smooth transition for background and text color */
}

/* Hover effect for dropdown links */
.x-dropdown-link:hover {
    background-color: #5bc0de; /* Lighter blue background on hover */
    color: #ffffff; /* Maintain text color (white) on hover */
}



.packages-bookings-section {
    background-color: #f4f0ff; /* Very light purple background for the section */
    padding: 40px 20px; /* Padding around the section */
    margin: 20px auto; /* Center the section with auto margin on left and right */
    border-radius: 8px; /* Rounded corners */
    border: 2px solid #7f5fc4; /* Purple border for the container */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    width: 90%; /* Decrease container width */
    max-width: 1200px; /* Set a maximum width for large screens */
    animation: dance 1s ease infinite; /* Dancing effect */
}

@keyframes dance {
    0%, 100% {
        transform: translateY(0); /* Start and end position */
    }
    25% {
        transform: translateY(-5px); /* Move up */
    }
    50% {
        transform: translateY(0); /* Move back to original position */
    }
    75% {
        transform: translateY(5px); /* Move down */
    }
}

.packages-bookings-section h2 {
    color: #6f42c1; /* Dark purple for the heading */
    font-size: 2rem; /* Increase font size for the heading */
    margin-bottom: 20px; /* Space below the heading */
    transition: color 0.3s ease; /* Animation for color change */
}

.packages-bookings-section h2:hover {
    color: #5a32a1; /* Darker purple on hover */
}

.packages-bookings-section .table {
    background-color: #ffffff; /* White background for the table */
    border-radius: 8px; /* Rounded corners for the table */
    overflow: hidden; /* Ensures rounded corners work for the table */
    width: 100%; /* Increase table width to fill container */
    transition: transform 0.3s ease; /* Animation for table scaling */
}

.packages-bookings-section .table:hover {
    transform: scale(1.01); /* Scale up slightly on hover */
}

.packages-bookings-section .table th, 
.packages-bookings-section .table td {
    vertical-align: middle; /* Center align table cell content */
    border: 1px solid #ddd; /* Add a light gray border to table cells */
}

.packages-bookings-section .table th {
    background-color: #7f5fc4; /* Purple color for the header */
    color: white; /* White text color for header */
}

.packages-bookings-section .table-striped tbody tr:nth-of-type(odd) {
    background-color: #e9d8f5; /* Light purple for odd rows */
}

.packages-bookings-section .table-striped tbody tr:nth-of-type(even) {
    background-color: #f4f0ff; /* Very light purple for even rows */
}

.packages-bookings-section .table tbody tr:hover {
    background-color: #d0c4e3; /* Slightly darker light purple for row hover effect */
}



    </style>
</head>
<body>

<header>
                <!-- Login/Register -->
                @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if (Auth::user()->role === 'admin')
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    {{ __('Admin Dashboard') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('customer.dashboard')">
                                    {{ __('Customer Dashboard') }}
                                </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </div>
                @endif
            </div>
</header>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="logo">
        <i class="fas fa-paper-plane"></i> <!-- Adjust icon size if needed -->
        <span>TravelXplorer</span>
    </div>

    <div class="nav flex-column">
        <!-- Existing Links -->
        <div class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
        </div>
        <div class="nav-item">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a> <!-- Active link to Admin Dashboard -->
        </div>
        <div class="nav-item">
            <a href="#package-management" class="nav-link">Package Management</a>
        </div>
        <div class="nav-item">
            <a href="#booking-management" class="nav-link">Booking Management</a>
        </div>
        <div class="nav-item">
            <a href="#gallery-section" class="nav-link">Gallery Management</a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link">User Management</a>
        </div>

        <!-- Settings Dropdown -->
        <div class="nav-item">
            <a class="nav-link" id="settingsToggle" href="#">Settings</a>
            <div id="settingsLinks" class="d-none">
                <a class="nav-link" href="{{ route('settings.index') }}">Contact Us Management</a>
                <a class="nav-link" href="{{ route('admin.password.change') }}">Change Password</a>
            </div>
        </div>
    </div>
</div>

<!-- Add this script at the bottom of your Blade view or in a separate JS file -->
<script>
    document.getElementById('settingsToggle').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        var settingsLinks = document.getElementById('settingsLinks');
        if (settingsLinks.classList.contains('d-none')) {
            settingsLinks.classList.remove('d-none'); // Show links
        } else {
            settingsLinks.classList.add('d-none'); // Hide links
        }
    });
</script>








@yield('content')
        @yield('scripts')

        <footer>
            @include('partials.footer')
        </footer>
    </div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</body>
</html>
