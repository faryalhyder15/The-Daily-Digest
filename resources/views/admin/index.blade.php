@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container mt-5">

    {{-- Header --}}
    <div class="text-center mb-5 py-4" style="background: linear-gradient(135deg, #667eea, #764ba2, #f093fb); border-radius: 24px; color: white;">
        <i class="fas fa-shield-alt fa-3x mb-3"></i>
        <h1 style="font-family: 'Playfair Display', serif;">Admin Dashboard</h1>
        <p style="opacity: 0.9;">Manage your blog from here</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    {{-- Stats Cards --}}
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card p-4 text-center">
                <div style="background: linear-gradient(135deg, #667eea, #764ba2); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                    <i class="fas fa-pen-nib fa-2x text-white"></i>
                </div>
                <h2 style="color: #764ba2; font-family: 'Playfair Display', serif;">{{ $totalPosts }}</h2>
                <p class="text-muted mb-0">Total Posts</p>
                <a href="/admin/posts" class="btn btn-primary-custom btn-sm mt-3">Manage Posts</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 text-center">
                <div style="background: linear-gradient(135deg, #f093fb, #f5576c); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                    <i class="fas fa-users fa-2x text-white"></i>
                </div>
                <h2 style="color: #f093fb; font-family: 'Playfair Display', serif;">{{ $totalUsers }}</h2>
                <p class="text-muted mb-0">Total Users</p>
                <a href="/admin/users" class="btn btn-pink btn-sm mt-3">Manage Users</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 text-center">
                <div style="background: linear-gradient(135deg, #43e97b, #38f9d7); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                    <i class="fas fa-comments fa-2x text-white"></i>
                </div>
                <h2 style="color: #43e97b; font-family: 'Playfair Display', serif;">{{ $totalComments ?? 0 }}</h2>
                <p class="text-muted mb-0">Total Comments</p>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Latest Posts --}}
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h5 class="section-title mb-4"><i class="fas fa-clock"></i> Latest Posts</h5>
                @forelse($latestPosts as $post)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom: 1px solid #f0e6ff;">
                        <div>
                            <p class="mb-0 fw-600" style="color: #2d2d4e;">{{ Str::limit($post->title, 30) }}</p>
                            <small class="text-muted">by {{ $post->user->name ?? 'Admin' }} · {{ $post->created_at->format('M d') }}</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="/posts/{{ $post->slug }}" class="btn btn-outline-custom btn-sm"><i class="fas fa-eye"></i></a>
                            <form action="/admin/posts/{{ $post->slug }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-pink btn-sm" onclick="return confirm('Delete?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No posts yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Latest Users --}}
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h5 class="section-title mb-4"><i class="fas fa-user-plus"></i> Latest Users</h5>
                @forelse($latestUsers as $user)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom: 1px solid #f0e6ff;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="background: linear-gradient(135deg, #667eea, #f093fb); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-600" style="color: #2d2d4e;">{{ $user->name }}</p>
                                <small class="text-muted">{{ $user->email }}</small>
                            </div>
                        </div>
                        <form action="/admin/users/{{ $user->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-pink btn-sm" onclick="return confirm('Delete user?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                @empty
                    <p class="text-muted">No users yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection