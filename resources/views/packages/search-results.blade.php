{{-- packages/search-results.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
.search-results {
    max-width: 500px; /* Decreased maximum width for the container */
    margin: 20px auto; /* Center the container */
    padding: 20px; /* Adjusted padding */
    background-color: #f9f9f9; /* Light background color */
    border: 2px solid #6A1B9A; /* Purple border color */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.search-results h1 {
    text-align: center; /* Center the main heading */
    color: #6A1B9A; /* Purple color for main heading */
    margin-bottom: 15px; /* Space below the heading */
    font-size: 26px; /* Font size for the main heading */
    font-weight: bold; /* Make the main heading bold */
}

.search-results h2 {
    color: #6A1B9A; /* Purple color for package name */
    font-size: 22px; /* Font size for package name */
    margin-bottom: 8px; /* Space below package name */
    font-weight: bold; /* Make the package name bold */
    text-align: left; /* Left-align package name text */
}

.search-results p {
    font-size: 14px; /* Font size for details */
    color: #555; /* Darker text color for better readability */
    margin: 4px 0; /* Margin for spacing between paragraphs */
    text-align: left; /* Left-align text for details */
}

.alert {
    margin-bottom: 15px; /* Space below the alert */
    padding: 10px; /* Padding inside the alert */
    background-color: #ffecb3; /* Light yellow background for alert */
    color: #856404; /* Darker color for alert text */
    border: 1px solid #ffeeba; /* Border for alert */
    border-radius: 5px; /* Rounded corners for alert */
    text-align: center; /* Center alert text */
}

img {
    max-width: 100%; /* Ensure images are responsive */
    height: auto; /* Maintain aspect ratio */
    border: 2px solid #6A1B9A; /* Purple border around images */
    transition: transform 0.3s; /* Smooth scaling on hover */
    border-radius: 5px; /* Rounded corners for images */
}

img:hover {
    transform: scale(1.05); /* Scale image slightly on hover */
}

.package-card {
    flex: 1 0 280px; /* Flexible card size */
    border: 1px solid #ddd; /* Light border around package card */
    border-radius: 8px; /* Rounded corners */
    padding: 10px; /* Increased padding inside the card */
    background-color: #f9f9f9; /* Light background color */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    text-align: left; /* Left-align text in the card */
    margin: 10px; /* Space between cards */
    transition: box-shadow 0.3s; /* Smooth shadow transition */
    max-height: 500px; /* Increased maximum height for the card */
    display: flex; /* Enable flexbox layout */
    flex-direction: column; /* Arrange content vertically */
}

.package-card img {
    max-height: 150px; /* Set a maximum height for the image */
    object-fit: cover; /* Ensure the image covers the area without distortion */
    margin-bottom: 10px; /* Space below the image */
}

.package-card h2,
.package-card p {
    flex-shrink: 0; /* Prevent text from shrinking */
    text-align: left; /* Left-align text in package cards */
}

.package-card .package-details {
    flex-grow: 1; /* Allow this section to grow */
    display: flex;
    flex-direction: column; /* Stack details vertically */
    justify-content: center; /* Center content vertically */
}

.package-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

.btn {
    display: inline-block; /* Inline block for buttons */
    text-align: center; 
    padding: 8px 12px; /* Adjusted padding */
    border-radius: 5px; 
    margin-top: 8px; /* Reduced margin */
    text-decoration: none; 
    font-weight: bold; /* Bold text */
}

.btn-book-now {
    background-color: #6A1B9A; /* Book Now button color */
    color: white; /* Text color for button */
}

.btn-booking-closed {
    background-color: #ccc; /* Color for Booking Closed button */
    color: white; /* Text color for disabled button */
}

@media (max-width: 600px) {
    .search-results {
        padding: 10px; /* Reduce padding for smaller screens */
    }

    .search-results h1 {
        font-size: 24px; /* Smaller heading size */
    }

    .search-results h2 {
        font-size: 20px; /* Smaller package name size */
    }

    .search-results p {
        font-size: 12px; /* Smaller detail size */
    }
}



</style>

<div class="search-results">
    <h1>Search Results</h1>

    @if (session('message'))
        <div class="alert">
            {{ session('message') }}
        </div>
    @endif

    @if ($packages->isEmpty())
        <div style="padding: 20px; text-align: center;">
            <h2>No Packages Available</h2>
            <p>Try adjusting your search criteria.</p>
        </div>
    @else
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
            @foreach ($packages as $package)
                <div class="package-card">
                    <img src="{{ $package->image ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}" alt="{{ $package->package_name }}" style="width: 100%; height: auto;">
                    <h2>{{ $package->package_name }}</h2>
                    <p><strong>Location:</strong> {{ $package->location }}</p>
                    <p><strong>Description:</strong> {{ $package->description }}</p>
                    <p><strong>Price per Person:</strong> {{ number_format($package->price_per_person, 2) }} Tk</p>
                    <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($package->starting_date)->format('M d, Y') }}</p>
                    <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($package->ending_date)->format('M d, Y') }}</p>

                    @if ($package->booking_enabled)
                        <a href="{{ route('bookings.customer-info', $package->id) }}" class="btn btn-book-now">Book Now</a>
                    @else
                        <button class="btn btn-booking-closed" disabled>Booking Closed</button>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection




