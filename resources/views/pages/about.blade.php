@extends('layouts.app')
@section('title', 'About Us')
@section('content')
<div class="container mt-5">

    {{-- Hero --}}
    <div class="text-center mb-5 py-5" style="background: linear-gradient(135deg, #667eea, #f093fb); border-radius: 24px; color: white;">
        <i class="fas fa-feather-alt fa-4x mb-3"></i>
        <h1 style="font-family: 'Playfair Display', serif; font-size: 3rem;">About The Daily Digest</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">A place where stories come to life </p>
    </div>

    {{-- Mission --}}
<div class="row align-items-center mb-5 justify-content-center text-center">
    <div class="col-md-6">
        <h2 class="section-title mb-3">Our Mission</h2>
        <p style="color: #666; line-height: 1.9; font-size: 1.05rem;">
            The Daily Digest is a creative space dedicated to sharing inspiring stories, thoughts, and ideas. We believe every voice deserves to be heard, and every story deserves to be told.
        </p>
        <p style="color: #666; line-height: 1.9; font-size: 1.05rem;">
            Whether you're here to read, learn, or share you're in the right place. Join our growing community of writers and readers from around the world.
        </p>
    </div>
</div>

    {{-- Stats --}}
    <div class="row mb-5 text-center">
        <div class="col-md-4 mb-3">
            <div class="card p-4">
                <i class="fas fa-pen-nib fa-3x mb-3" style="color: #667eea;"></i>
                <h3 style="color: #764ba2; font-family: 'Playfair Display', serif;">Stories</h3>
                <p class="text-muted">Inspiring stories shared daily</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4">
                <i class="fas fa-users fa-3x mb-3" style="color: #f093fb;"></i>
                <h3 style="color: #764ba2; font-family: 'Playfair Display', serif;">Community</h3>
                <p class="text-muted">A growing family of writers</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4">
                <i class="fas fa-comments fa-3x mb-3" style="color: #764ba2;"></i>
                <h3 style="color: #764ba2; font-family: 'Playfair Display', serif;">Discussions</h3>
                <p class="text-muted">Meaningful conversations every day</p>
            </div>
        </div>
    </div>

</div>
@endsection