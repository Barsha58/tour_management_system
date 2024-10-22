@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Change Password (Admin)</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf

        <div class="mb-3">
            <label for="old_password" class="form-label">Old Password</label>
            <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required>
            @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>
@endsection
