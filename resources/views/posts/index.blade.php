@extends('layouts.app')
@section('title', 'The Daily Digest - Home')
@section('content')

<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 70px 0 50px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0; right: 0;
        height: 50px;
        background: #f8f9fc;
        clip-path: ellipse(55% 100% at 50% 100%);
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 700;
        letter-spacing: -0.5px;
    }
    .hero-subtitle {
        opacity: 0.85;
        font-size: 1.05rem;
        margin-bottom: 0;
    }
    .write-btn {
        background: white;
        color: #764ba2;
        font-weight: 600;
        border-radius: 30px;
        padding: 10px 28px;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .write-btn:hover {
        background: #f0e6ff;
        color: #764ba2;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* Search */
    .search-wrap {
        background: white;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(102,126,234,0.12);
        overflow: hidden;
        display: flex;
    }
    .search-wrap input {
        border: none;
        outline: none;
        padding: 14px 20px;
        font-size: 0.95rem;
        flex: 1;
        color: #2d2d4e;
    }
    .search-wrap button {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 14px 24px;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    .search-wrap button:hover { opacity: 0.9; }

    /* Filters */
    .filter-bar {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }
    .filter-btn {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 500;
        border: 1.5px solid #e0d6f5;
        color: #764ba2;
        background: white;
        text-decoration: none;
        transition: all 0.15s;
    }
    .filter-btn:hover, .filter-btn.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-color: transparent;
    }

    /* Post Cards */
    .post-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(102,126,234,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .post-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(102,126,234,0.16);
    }
    .post-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .post-placeholder {
        height: 200px;
        background: linear-gradient(135deg, #667eea, #f093fb);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .post-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .post-category {
        font-size: 0.75rem;
        font-weight: 600;
        color: #764ba2;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    .post-title a {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: #2d2d4e;
        text-decoration: none;
        font-weight: 700;
        line-height: 1.4;
    }
    .post-title a:hover { color: #764ba2; }
    .post-excerpt {
        color: #777;
        font-size: 0.88rem;
        line-height: 1.6;
        margin-top: 8px;
        flex: 1;
    }
    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 20px;
        border-top: 1px solid #f5f0ff;
        background: #fdfbff;
    }
    .post-meta-sm {
        font-size: 0.78rem;
        color: #aaa;
        display: flex;
        gap: 12px;
    }
    .read-btn {
        font-size: 0.8rem;
        font-weight: 600;
        color: #764ba2;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .read-btn:hover { color: #667eea; }

    /* Section header */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .section-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: #2d2d4e;
        font-weight: 700;
        margin: 0;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-icon {
        width: 80px; height: 80px;
        background: linear-gradient(135deg, #667eea, #f093fb);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
    }

    /* Pagination */
    .page-link-custom {
        width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
        border: 1.5px solid #e0d6f5;
        color: #764ba2;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.15s;
    }
    .page-link-custom:hover, .page-link-custom.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-color: transparent;
    }
    .page-link-custom.disabled { color: #ccc; pointer-events: none; }
</style>

{{-- Hero --}}
<div class="hero-section">
    <div class="container text-center">
        <p style="font-size:0.85rem; letter-spacing:2px; text-transform:uppercase; opacity:0.7; margin-bottom:10px;">
            <i class="fas fa-feather-alt"></i> &nbsp; Welcome
        </p>
        <h1 class="hero-title mb-3">Stories Worth Reading</h1>
        <p class="hero-subtitle mb-4">Thoughts, ideas, and tales from our writers</p>
        @auth
            <a href="/posts/create" class="write-btn">
                <i class="fas fa-plus me-1"></i> Write a Story
            </a>
        @endauth
    </div>
</div>

<div style="background:#f8f9fc; min-height:100vh; padding-top:40px; padding-bottom:60px;">
<div class="container">

    {{-- Search --}}
    <div class="row justify-content-center mb-5">
        <div class="col-md-7">
            <form action="/" method="GET">
                <div class="search-wrap">
                    <input type="text" name="search" placeholder="Search stories..." value="{{ request('search') }}">
                    <button type="submit"><i class="fas fa-search me-1"></i> Search</button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
    @endif

    {{-- Section Header + Filters --}}
    <div class="section-header">
        <h2 class="section-heading"><i class="fas fa-book-open me-2" style="color:#764ba2;"></i>Stories</h2>
        <div class="filter-bar">
            <a href="/?sort=latest" class="filter-btn {{ request('sort', 'latest') == 'latest' ? 'active' : '' }}">Latest</a>
            <a href="/?sort=oldest" class="filter-btn {{ request('sort') == 'oldest' ? 'active' : '' }}">Oldest</a>
            @foreach($categories as $category)
                <a href="/?category={{ $category->slug }}" class="filter-btn {{ request('category') == $category->slug ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Search result notice --}}
    @if(request('search'))
        <p class="text-muted mb-4" style="font-size:0.88rem;">
            Results for <strong style="color:#764ba2;">"{{ request('search') }}"</strong>
            <a href="/" class="ms-2" style="color:#aaa; font-size:0.82rem;"><i class="fas fa-times"></i> Clear</a>
        </p>
    @endif

    {{-- Posts Grid --}}
    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-md-4">
                <div class="post-card">
                    @if($post->image)
                        <img src="{{ $post->image }}" alt="{{ $post->title }}">
                    @else
                        <div class="post-placeholder">
                            <i class="fas fa-feather-alt fa-2x text-white opacity-75"></i>
                        </div>
                    @endif
                    <div class="post-card-body">
                        @if($post->category)
                            <div class="post-category"><i class="fas fa-tag me-1"></i>{{ $post->category->name }}</div>
                        @endif
                        <h5 class="post-title mb-0">
                            <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                        </h5>
                        <p class="post-excerpt">{{ Str::limit($post->body, 90) }}</p>
                    </div>
                    <div class="post-footer">
                        <div class="post-meta-sm">
                            <span><i class="fas fa-calendar-alt me-1"></i>{{ $post->created_at->format('M d, Y') }}</span>
                            <span><i class="fas fa-comments me-1"></i>{{ $post->comments->count() }}</span>
                        </div>
                        <a href="/posts/{{ $post->slug }}" class="read-btn">
                            Read <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-feather-alt fa-2x text-white"></i>
                    </div>
                    <h4 style="font-family:'Playfair Display',serif; color:#2d2d4e;">No stories yet</h4>
                    <p class="text-muted">Be the first to share your thoughts.</p>
                    @auth
                        <a href="/posts/create" class="write-btn mt-2" style="background:linear-gradient(135deg,#667eea,#764ba2);color:white;">
                            Write First Story
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($posts, 'hasPages') && $posts->hasPages())
        <div class="d-flex justify-content-center gap-2 mt-5">
            @if($posts->onFirstPage())
                <span class="page-link-custom disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" class="page-link-custom"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="page-link-custom {{ $page == $posts->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" class="page-link-custom"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="page-link-custom disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    @endif

</div>
</div>

@endsection