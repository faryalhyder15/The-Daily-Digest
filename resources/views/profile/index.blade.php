@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
<div class="container mt-5">

    {{-- Profile Header --}}
    <div class="text-center mb-5 py-5" style="background: linear-gradient(135deg, #667eea, #764ba2, #f093fb); border-radius: 24px; color: white;">
        <div style="width: 100px; height: 100px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
            <i class="fas fa-user fa-3x" style="color: #764ba2;"></i>
        </div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 2rem;">{{ $user->name }}</h2>
        <p style="opacity: 0.9;">{{ $user->email }}</p>
        <p style="opacity: 0.8;"><i class="fas fa-calendar-alt"></i> Joined {{ $user->created_at->format('M d, Y') }}</p>
        <div class="d-flex justify-content-center gap-4 mt-3">
            <div>
                <h4 class="mb-0">{{ $posts->count() }}</h4>
                <small>Posts</small>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Update Profile Form --}}
        <div class="col-md-5 mb-4">
            <div class="auth-card" style="max-width: 100%; margin: 0;">
                <h4 class="auth-title"><i class="fas fa-edit"></i> Edit Profile</h4>

                @if(session('success'))
                    <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
                @endif

                <form method="POST" action="/profile">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password <small class="text-muted">(leave blank to keep current)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Min 8 characters">
                        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password">
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 py-3">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                </form>
            </div>
        </div>

        {{-- My Posts --}}
        <div class="col-md-7 mb-4">
            <h4 class="section-title mb-4"><i class="fas fa-book-open"></i> My Stories</h4>

            @forelse($posts as $post)
                <div class="card mb-3 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 style="font-family: 'Playfair Display', serif; color: #2d2d4e; margin-bottom: 4px;">
                                <a href="/posts/{{ $post->slug }}" style="color: #2d2d4e; text-decoration: none;">{{ $post->title }}</a>
                            </h6>
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format('M d, Y') }}
                                &nbsp;|&nbsp;
                                <i class="fas fa-comments"></i> {{ $post->comments->count() }} comments
                                @if($post->category)
                                    &nbsp;|&nbsp;
                                    <span class="badge-category" style="font-size:0.7rem;">{{ $post->category->name }}</span>
                                @endif
                            </small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="/posts/{{ $post->slug }}/edit" class="btn btn-outline-custom btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/posts/{{ $post->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-pink btn-sm" onclick="return confirm('Delete?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-feather-alt fa-3x mb-3" style="color: #e8e0f5;"></i>
                    <p class="text-muted">You haven't written any stories yet.</p>
                    <a href="/posts/create" class="btn btn-primary-custom">Write First Story</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection