@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container">
    <div class="auth-card">
        <h2 class="auth-title text-center"><i class="fas fa-key"></i> Forgot Password?</h2>
        <p class="text-center text-muted mb-4">No worries! Enter your email and we'll send you a reset link.</p>

        @if(session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary-custom w-100 py-3" style="font-size:1.1rem;">
                <i class="fas fa-paper-plane"></i> Send Reset Link
            </button>
        </form>

        <hr style="border-color: #e8e0f5; margin: 25px 0;">

        <p class="text-center text-muted mb-0">
            Remember your password?
            <a href="/login" style="color: #764ba2; font-weight: 600;">Login</a>
        </p>
    </div>
</div>
@endsection