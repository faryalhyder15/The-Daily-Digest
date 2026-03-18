@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<div class="container mt-5" style="max-width: 700px;">

    <div class="text-center mb-5">
        <h1 class="section-title"><i class="fas fa-envelope"></i> Contact Us</h1>
        <p class="text-muted">Have a question or suggestion? We'd love to hear from you!</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <div class="auth-card" style="max-width: 100%;">
        <form method="POST" action="/contact">
            @csrf
            <div class="mb-4">
                <label class="form-label"><i class="fas fa-user"></i> Your Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required>
                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label"><i class="fas fa-tag"></i> Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="What is this about?" value="{{ old('subject') }}">
            </div>
            <div class="mb-4">
                <label class="form-label"><i class="fas fa-comment"></i> Message</label>
                <textarea name="message" class="form-control" rows="6" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                @error('message')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <button type="submit" class="btn btn-primary-custom w-100 py-3" style="font-size:1.1rem;">
                <i class="fas fa-paper-plane"></i> Send Message
            </button>
        </form>

        <hr style="border-color: #e8e0f5; margin: 30px 0;">

        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div style="background: linear-gradient(135deg, #f8f9ff, #fff0f6); border-radius: 16px; padding: 20px;">
                    <i class="fas fa-envelope fa-2x mb-2" style="color: #764ba2;"></i>
                    <p class="mb-0 text-muted" style="font-size:0.85rem;">tdd@gmail.com</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div style="background: linear-gradient(135deg, #f8f9ff, #fff0f6); border-radius: 16px; padding: 20px;">
                    <i class="fas fa-map-marker-alt fa-2x mb-2" style="color: #f093fb;"></i>
                    <p class="mb-0 text-muted" style="font-size:0.85rem;">Pakistan</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div style="background: linear-gradient(135deg, #f8f9ff, #fff0f6); border-radius: 16px; padding: 20px;">
                    <i class="fas fa-clock fa-2x mb-2" style="color: #667eea;"></i>
                    <p class="mb-0 text-muted" style="font-size:0.85rem;">Mon - Fri,
                        <br>9am - 6pm
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection