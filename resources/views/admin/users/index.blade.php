@extends('layouts.admin')

@section('content')
<style>
    /* Centered Heading Styles */
    .centered-heading {
        text-align: center; /* Center the text */
        margin: 30px 0; /* Add space above and below the heading */
        color: #6F1D99; /* Purple color */
        position: relative; /* For pseudo-element positioning */
        opacity: 0; /* Start with transparent */
        animation: fadeIn 1s forwards; /* Fade-in animation */
    }

    @keyframes fadeIn {
        to {
            opacity: 1; /* Fade to fully visible */
        }
    }

    /* Underline Animation */
    .centered-heading::after {
        content: ""; /* Required for the pseudo-element */
        display: block; /* Make it a block element */
        height: 3px; /* Thickness of the underline */
        background: #6F1D99; /* Purple color for underline */
        width: 0; /* Start with zero width */
        transition: width 0.5s; /* Animation duration */
        margin: 0 auto; /* Center the underline */
    }

    .centered-heading:hover::after {
        width: 100%; /* Expand to full width on hover */
    }

    /* Update Role Button Styles */
    .btn-update-role {
        transition: background-color 0.3s, transform 0.3s; /* Animation on hover */
    }

    .btn-update-role:hover {
        background-color: #4e2b7f; /* Darker shade of purple */
        transform: scale(1.05); /* Slightly increase size */
    }

    /* Delete Button Styles */
    .btn-delete {
        background-color: #dc3545; /* Red background for delete */
        color: white; /* White text */
        transition: background-color 0.3s, transform 0.3s; /* Animation on hover */
    }

    .btn-delete:hover {
        background-color: #c82333; /* Darker red on hover */
        transform: scale(1.05); /* Slightly increase size */
    }

    /* Centering Table Headers */
    .table thead th {
        text-align: center; /* Center the table headers */
        background-color: #6F1D99; /* Optional: Light background for table headers */
    }

    /* Centering Table Cells */
    .table tbody td {
        text-align: center; /* Center the table cell contents */
    }
</style>

<div class="container">
    <h2 class="centered-heading">User Management</h2> <!-- Centered and animated heading -->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Admin Table -->
    <h3 class="centered-heading">Admin Users</h3>

    <div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Add New User</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ ucfirst($admin->role) }}</td>
                    <td>
                        <!-- Button to toggle the update form -->
                        <button class="btn btn-secondary mt-2" data-toggle="collapse" data-target="#updateForm{{ $admin->id }}" aria-expanded="false" aria-controls="updateForm{{ $admin->id }}">
                            Update Name & Email
                        </button>

                        <!-- Update Form Toggle -->
                        <div class="collapse" id="updateForm{{ $admin->id }}">
                            <form action="{{ route('admin.users.update', $admin->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#updateForm{{ $admin->id }}">Cancel</button>
                            </form>
                        </div>

                        <!-- Form to delete user -->
                        <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Customer Table -->
    <h3 class="centered-heading">Customer Users</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ ucfirst($customer->role) }}</td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
