@extends('layouts.app')

@section('content')
<style>
.customer-info {
    margin: 20px auto; /* Center the container with auto margins */
    max-width: 600px; /* Increased maximum width for the container */
    height: auto; /* Allow the height to expand based on content */
    background-color: #f8f8f8; /* Light background color for better contrast */
    padding: 18px; /* Reduced padding inside the container for height adjustment */
    border-radius: 10px; /* Rounded corners for the container */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    animation: fadeIn 0.5s ease-in-out; /* Fade-in animation for the container */
    border: 5px solid #6A1B9A; /* Purple border around the container */
}

/* Animation for the customer info container */
@keyframes fadeIn {
    from {
        opacity: 0; /* Start fully transparent */
        transform: translateY(-10px); /* Start slightly above */
    }
    to {
        opacity: 1; /* End fully visible */
        transform: translateY(0); /* End at original position */
    }
}

.customer-info h1 {
    text-align: center; /* Center the heading */
    color: #6A1B9A; /* Use the specified purple color */
    font-size: 30px; /* Decreased size for the heading */
    font-weight: bold; /* Make the heading bold */
    margin-bottom: 15px; /* Space below the heading */
    animation: titleFadeIn 0.5s ease-in-out; /* Fade-in animation for the heading */
}

/* Animation for the heading */
@keyframes titleFadeIn {
    from {
        opacity: 0; /* Start fully transparent */
        transform: translateY(-10px); /* Start slightly above */
    }
    to {
        opacity: 1; /* End fully visible */
        transform: translateY(0); /* End at original position */
    }
}

.customer-info p, .customer-info input {
    font-size: 16px; /* Decreased font size for user and package details */
    color: #555; /* Darker text color for better readability */
    margin: 8px 0; /* Margin for spacing between paragraphs */
}

/* Input styles */
.input-group {
    margin-bottom: 15px; /* Decreased space between input groups */
}

.input-group input {
    width: 100%; /* Full width for inputs */
    padding: 5px; /* Reduced padding inside the inputs for height adjustment */
    border: 1px solid #ccc; /* Light border color */
    border-radius: 5px; /* Rounded corners for inputs */
    font-size: 16px; /* Decreased font size for inputs */
    transition: border-color 0.3s, box-shadow 0.3s; /* Transition effects */
    animation: inputFadeIn 0.5s ease-in-out; /* Fade-in animation for inputs */
}

/* Animation for inputs */
@keyframes inputFadeIn {
    from {
        opacity: 0; /* Start fully transparent */
        transform: translateY(10px); /* Start slightly below */
    }
    to {
        opacity: 1; /* End fully visible */
        transform: translateY(0); /* End at original position */
    }
}

.input-group input:focus {
    border-color: #6A1B9A; /* Change border color on focus */
    box-shadow: 0 0 5px rgba(106, 27, 154, 0.5); /* Add shadow on focus */
    outline: none; /* Remove default outline */
}

button {
    width: 100%; /* Full width for the button */
    padding: 10px; /* Reduced padding inside the button for height adjustment */
    background-color: #6A1B9A; /* Use the specified purple color */
    color: #fff; /* White text color */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners for button */
    font-size: 16px; /* Decreased font size for button */
    cursor: pointer; /* Change cursor to pointer */
    transition: background-color 0.3s, transform 0.3s; /* Transition effects */
    margin-top: 10px; /* Space above the button */
}

/* Button hover styles */
button:hover {
    background-color: #007BFF; /* Blue color on hover */
}

.input-group label {
    display: block; /* Make the label a block element to stack it above the input */
    font-size: 16px; /* Decreased font size for the labels */
    color: #6A1B9A; /* Purple color for the labels */
    margin-bottom: 5px; /* Space between label and input */
    font-weight: bold; /* Make the label text bold */
}

</style>

<div class="customer-info">
    <h1>CUSTOMER INFORMATION</h1>

    <form action="{{ route('bookings.store-customer-info') }}" method="POST">
        @csrf
        <input type="hidden" name="package_id" value="{{ $package->id }}">

        <!-- Display user details -->
        <div class="input-group">
            <label for="customer_name">Name</label>
            <input type="text" id="customer_name" name="customer_name" value="{{ $user->name }}" readonly>
        </div>

        <div class="input-group">
            <label for="customer_email">Email</label>
            <input type="text" id="customer_email" name="customer_email" value="{{ $user->email }}" readonly>
        </div>

        <!-- Package details -->
        <div class="input-group">
            <label for="package_name">Package</label>
            <input type="text" id="package_name" name="package_name" value="{{ $package->package_name }}" readonly>
        </div>

        <div class="input-group">
            <label for="package_description">Description</label>
            <input type="text" id="package_description" name="package_description" value="{{ $package->description }}" readonly>
        </div>

        <div class="input-group">
            <label for="package_price">Price per Person</label>
            <input type="text" id="package_price" name="package_price" value="{{ $package->price_per_person }}" readonly>
        </div>

        <div class="input-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" required placeholder="Phone Number" onfocus="this.placeholder=''" onblur="if(!this.value)this.placeholder='Phone Number'">
        </div>

        <div class="input-group">
            <label for="number_of_people">Number of People</label>
            <input type="number" id="number_of_people" name="number_of_people" min="1" required placeholder="Number of People" onfocus="this.placeholder=''" onblur="if(!this.value)this.placeholder='Number of People'">
        </div>

        <button type="submit">Next</button>
    </form>
</div>
@endsection


