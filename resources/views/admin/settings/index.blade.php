@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Manage Contact Us Information</h2>

    <!-- Display Contact Us information if it exists -->
    @if($contact)
        <div class="card mb-4">
            <div class="card-header">Current Contact Us Information</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p>No contact information available. Please add new information below.</p>
    @endif

    <!-- Form to update or create Contact Us information -->
    <div class="card mb-4">
        <div class="card-header">{{ $contact ? 'Update' : 'Create' }} Contact Us Information</div>
        <div class="card-body">
            <form action="{{ route('settings.updateContact') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $contact->email ?? old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone ?? old('phone') }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address ?? old('address') }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">{{ $contact ? 'Update' : 'Create' }} Contact Us</button>
            </form>
        </div>
    </div>
</div>


@endsection

