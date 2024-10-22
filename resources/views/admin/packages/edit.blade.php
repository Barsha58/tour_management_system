@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Package</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="package_name">Package Name</label>
            <input type="text" name="package_name" class="form-control" value="{{ old('package_name', $package->package_name) }}" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $package->location) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description', $package->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="price_per_person">Price per Person</label>
            <input type="number" name="price_per_person" class="form-control" value="{{ old('price_per_person', $package->price_per_person) }}" required>
        </div>

        <div class="form-group">
            <label for="starting_date">Start Date</label>
            <input type="date" name="starting_date" class="form-control" value="{{ old('starting_date', $package->starting_date) }}" required>
        </div>

        <div class="form-group">
            <label for="ending_date">End Date</label>
            <input type="date" name="ending_date" class="form-control" value="{{ old('ending_date', $package->ending_date) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($package->image)
                <img src="{{ asset('storage/' . $package->image) }}" alt="Package Image" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="booking_enabled">Booking Enabled</label>
            <select name="booking_enabled" class="form-control" required>
                <option value="1" {{ $package->booking_enabled ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$package->booking_enabled ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="form-group">
    <label for="max_capacity">Max Capacity</label>
    <input type="number" class="form-control" id="max_capacity" name="max_capacity" value="{{ old('max_capacity', $package->max_capacity) }}" placeholder="Enter max capacity" required>
</div>

        <button type="submit" class="btn btn-primary">Update Package</button>
    </form>
</div>
@endsection

