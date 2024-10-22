<!-- resources/views/admin/gallery/edit.blade.php -->
@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>Edit Gallery Image</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>

            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" name="destination" id="destination" class="form-control" value="{{ $gallery->destination }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Image</button>
        </form>
    </div>
    @endsection
