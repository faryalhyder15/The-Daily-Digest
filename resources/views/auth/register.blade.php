@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="auth-card">
        <h2 class="auth-title text-center"><i class="fas fa-user-plus"></i> Sign Up</h2>
        <p class="text-center text-muted mb-4">Create your account and start sharing</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Your name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Min 8 characters" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
            </div>
            <button type="submit" class="btn btn-warm w-100 py-3" style="font-size:1.1rem;">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>

        <hr style="border-color: #e8d5c4; margin: 25px 0;">

        <p class="text-center text-muted mb-0">
            Already have an account?
            <a href="/login" style="color: #c17f5a; font-weight: 600;">Login</a>
        </p>
    </div>
</div>
@endsection