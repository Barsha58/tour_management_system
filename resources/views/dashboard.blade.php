@extends('layouts.admin') <!-- Assuming you have an admin layout -->

@section('content')
<div class="container">
    <h2>Manage Contact Us Information</h2>

    <!-- Display existing Contact Us details in a table -->
    <div class="card mb-4">
        <div class="card-header">Current Contact Us Information</div>
        <div class="card-body">
            @if($contacts->isEmpty())
                <p>No contact information available.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->address }}</td>
                                <td>
                                    <!-- Update and Delete Buttons -->
                                    <a href="{{ route('settings.editContact', $contact->id) }}" class="btn btn-sm btn-warning">Update</a>
                                    <form action="{{ route('settings.deleteContact', $contact->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this contact information?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Form to update or create Contact Us information -->
    <div class="card mb-4">
        <div class="card-header">Update/Create Contact Us Information</div>
        <div class="card-body">
            <form action="{{ route('settings.updateContact') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $contact->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update Contact Us</button>
            </form>
        </div>
    </div>

    <!-- Form to delete Contact Us -->
    <form action="{{ route('settings.deleteContact', $contact->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete the Contact Us content?')">Delete Contact Us</button>
    </form>
</div>
@endsection
@extends('layouts.admin') <!-- Assuming you have an admin layout -->

@section('content')
<div class="container">
    <h2>Manage Contact Us Information</h2>

    <!-- Display existing Contact Us details in a table -->
    <div class="card mb-4">
        <div class="card-header">Current Contact Us Information</div>
        <div class="card-body">
            @if($contacts->isEmpty())
                <p>No contact information available.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->address }}</td>
                                <td>
                                    <!-- Update and Delete Buttons -->
                                    <a href="{{ route('settings.editContact', $contact->id) }}" class="btn btn-sm btn-warning">Update</a>
                                    <form action="{{ route('settings.deleteContact', $contact->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this contact information?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Form to update or create Contact Us information -->
    <div class="card mb-4">
        <div class="card-header">Update/Create Contact Us Information</div>
        <div class="card-body">
            <form action="{{ route('settings.updateContact') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $contact->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update Contact Us</button>
            </form>
        </div>
    </div>

    <!-- Form to delete Contact Us -->
    <form action="{{ route('settings.deleteContact', $contact->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete the Contact Us content?')">Delete Contact Us</button>
    </form>
</div>
@endsection

