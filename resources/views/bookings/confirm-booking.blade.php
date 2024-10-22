@extends('layouts.app')

@section('content')
<style>
.confirmation-container {
    max-width: 600px; /* Maximum width for the container */
    margin: 20px auto; /* Center the container */
    padding: 20px; /* Padding inside the container */
    border: 5px solid #6A1B9A; /* Purple border color for the container */
    border-radius: 10px; /* Rounded corners for the container */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
    background-color: #f8f8f8; /* Light background color for better contrast */
}

.confirmation-container h1 {
    text-align: center; /* Center the heading */
    color: #6A1B9A; /* Purple color for the heading */
    margin-bottom: 20px; /* Space below the heading */
    font-size: 28px; /* Increased font size for the main heading */
    font-weight: bold; /* Bold the main heading */
}

.confirmation-container p {
    font-size: 16px; /* Font size for paragraphs */
    color: #555; /* Darker text color for better readability */
    margin: 10px 0; /* Margin for spacing between paragraphs */
    text-align: left; /* Left align the paragraphs */
}

.confirmation-container label {
    display: block; /* Make label a block element */
    font-size: 16px; /* Font size for labels */
    color: #6A1B9A; /* Purple color for labels */
    margin-bottom: 5px; /* Space between label and input */
    font-weight: bold; /* Make the label text bold */
}

.confirmation-container input[type="text"],
.confirmation-container input[type="email"],
.confirmation-container input[type="tel"],
.confirmation-container select {
    width: 100%; /* Full width for input fields */
    padding: 10px; /* Padding inside the input */
    border: 1px solid #ccc; /* Light border color */
    border-radius: 5px; /* Rounded corners for input */
    font-size: 16px; /* Font size for input */
    margin-bottom: 15px; /* Space below the input */
    transition: border-color 0.3s, box-shadow 0.3s; /* Transition effects */
    color: #6A1B9A; /* Purple text color for the input */
}

.confirmation-container input:focus,
.confirmation-container select:focus {
    border-color: #6A1B9A; /* Change border color on focus */
    box-shadow: 0 0 5px rgba(106, 27, 154, 0.5); /* Add shadow on focus */
    outline: none; /* Remove default outline */
}

.confirmation-container button {
    width: 100%; /* Full width for the button */
    padding: 12px; /* Padding inside the button */
    background-color: #6A1B9A; /* Button background color */
    color: #fff; /* White text color */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners for button */
    font-size: 16px; /* Font size for button */
    cursor: pointer; /* Change cursor to pointer */
    transition: background-color 0.3s, transform 0.3s; /* Transition effects */
    margin-top: 10px; /* Space above the button */
}

/* Button hover color */
.confirmation-container button:hover {
    background-color: #007BFF; /* Change button background to blue on hover */
}

.confirmation-container button:focus {
    outline: none; /* Remove outline when button is focused */
}
</style>

<div class="confirmation-container">
    <h1>Booking Confirmation</h1>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" readonly>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" readonly>

        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" id="phone" value="{{ $phone }}" readonly>

        <label for="package">Package</label>
        <input type="text" name="package" id="package" value="{{ $package->package_name }}" readonly>

        <label for="number_of_people">Number of People</label>
        <input type="text" name="number_of_people" id="number_of_people" value="{{ $number_of_people }}" readonly>

        <label for="total_amount">Total Amount</label>
        <input type="text" name="total_amount" id="total_amount" value="{{ $total_amount }}" readonly>

        <label for="payment_method">Select Payment Method</label>
        <select name="payment_method" required>
            <option value="cash">Cash</option>
            <option value="bkash">bKash</option>
            <option value="credit_card">Credit Card</option>
        </select>

        <input type="hidden" name="package_id" value="{{ $package->id }}">
        <input type="hidden" name="number_of_people" value="{{ $number_of_people }}">
        <input type="hidden" name="total_amount" value="{{ $total_amount }}">

        <button type="submit">Confirm Booking</button>
    </form>
</div>

@endsection



