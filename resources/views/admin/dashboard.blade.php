@extends('layouts.admin')
@section('title', 'Home')

@section('content')

<!-- Main content -->

<section id="admin-dashboard" class="mt-5">
    <!-- Welcome message -->
    <div class="content" id="content" style="text-align: center; margin-top: 20px;">
        <h1 style="font-weight: bold; color: purple;">Welcome to the Admin Dashboard</h1>
    </div>

    <div class="container">
        <!-- Display total statistics in two rows with three columns -->
        <div class="row">
            <div class="col-md-4 mb-3 d-flex justify-content-center">
                <div class="card text-center bg-light-purple text-white animated-card fadeInUp" style="width: 80%;">
                    <div class="card-body">
                        <h5 class="card-title">Total Admins</h5>
                        <p class="card-text">{{ $totalAdmins }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 d-flex justify-content-center">
                <div class="card text-center bg-purple text-white animated-card fadeInUp" style="width: 80%; animation-delay: 0.3s;">
                    <div class="card-body">
                        <h5 class="card-title">Total Customers</h5>
                        <p class="card-text">{{ $totalCustomers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 d-flex justify-content-center">
                <div class="card text-center bg-dark-purple text-white animated-card fadeInUp" style="width: 80%; animation-delay: 0.6s;">
                    <div class="card-body">
                        <h5 class="card-title">Total Packages</h5>
                        <p class="card-text">{{ $totalPackages }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3 d-flex justify-content-center">
                <div class="card text-center bg-lighter-purple text-white animated-card fadeInUp" style="width: 80%; animation-delay: 0.9s;">
                    <div class="card-body">
                        <h5 class="card-title">Total Bookings</h5>
                        <p class="card-text">{{ $totalBookings }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 d-flex justify-content-center">
                <div class="card text-center bg-deep-purple text-white animated-card fadeInUp" style="width: 80%; animation-delay: 1.2s;">
                    <div class="card-body">
                        <h5 class="card-title">Total Gallery Images</h5>
                        <p class="card-text">{{ $totalGalleryImages }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 d-flex justify-content-center">
                <div class="card text-center bg-purple-darker text-white animated-card fadeInUp" style="width: 80%; animation-delay: 1.5s;">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <p class="card-text">${{ number_format($totalRevenue, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="packages-bookings-section">
    <div class="container">
        <div class="text-center"> <!-- Added this div for centering -->
            <h2>Packages and Total Bookings</h2>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Package Name</th>
                    <th>Total Bookings</th>
                    <th>Max Capacity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->package_name }}</td>
                        <td>{{ $package->bookings_count }}</td> <!-- Total bookings for this package -->
                        <td>{{ $package->max_capacity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Package Management Section -->
<section id="package-management" class="mt-5">
    <h2 class="mt-4 text-center">Manage Packages</h2>
    <div class="d-flex justify-content-start mb-3">
    <a href="{{ route('admin.packages.create') }}" class="btn create-package-btn">Create Package</a>
</div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>Price per Person</th>
                <th>Starting Date</th>
                <th>Ending Date</th>
                <th>Max Capacity</th> 
                <th>Image</th>
                <th>Booking Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
                <tr>
                    <td>{{ $package->package_name }}</td>
                    <td>{{ $package->location }}</td>
                    <td>{{ $package->description }}</td>
                    <td>{{ $package->price_per_person }}</td>
                    <td>{{ \Carbon\Carbon::parse($package->starting_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($package->ending_date)->format('Y-m-d') }}</td>
                    <td>{{ $package->max_capacity }}</td> 
                    <td>
    <img src="{{ asset($package->image) }}" alt="{{ $package->package_name }}" class="img-small">
</td>

                    <td>
                        <form action="{{ route('admin.packages.toggleBooking', $package->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-{{ $package->booking_enabled ? 'success' : 'danger' }} btn-sm">
                                {{ $package->booking_enabled ? 'Disable Booking' : 'Enable Booking' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>  
    </table>
</section>


<!-- Booking Management Section -->
<section id="booking-management">
    <h2 class="mt-4"> Manage Bookings</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Package</th>
                <th>Total Persons</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Booking Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->package->package_name }}</td>
                    <td>{{ $booking->total_persons }}</td>
                    <td>${{ number_format($booking->total_amount, 2) }}</td>
                    <td>{{ ucfirst($booking->payment_method) }}</td>
                    <td>
                        <form action="{{ route('admin.booking.updatePaymentStatus', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <select name="payment_status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="pending" {{ $booking->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $booking->payment_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $booking->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ ucfirst($booking->booking_status) }}</td>
                    <td>
                        @if($booking->booking_status !== 'cancel')
                            <form action="{{ route('admin.booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" style="transition: background-color 0.3s; cursor: pointer;">
                                    Cancel
                                </button>
                            </form>
                        @else
                            <span>Canceled</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<!-- Gallery Section -->
<section id="gallery-section">
    <h2>Manage Gallery</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mb-3">Add New Image</a>
    <div class="row">
        @foreach($images as $image)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="{{ $image->destination }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $image->destination }}</h5>
                        <a href="{{ route('admin.gallery.edit', $image->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>


<!-- Add this to your Blade view where you want the settings button -->

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>




    @endsection