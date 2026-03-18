@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="container mt-5" style="max-width: 850px;">

    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    {{-- Cover Image --}}
    @if($post->image)
        <img src="{{ $post->image }}" class="w-100 mb-4" style="height: 450px; object-fit: cover; border-radius: 20px; box-shadow: 0 12px 40px rgba(102,126,234,0.2);">
    @endif

    {{-- Category --}}
    @if($post->category)
        <span class="badge-category mb-3 d-inline-block">
            <i class="fas fa-tag"></i> {{ $post->category->name }}
        </span>
    @endif

    {{-- Title --}}
    <h1 style="font-family: 'Playfair Display', serif; color: #2d2d4e; font-size: 2.8rem; line-height: 1.3;">{{ $post->title }}</h1>

    {{-- Meta --}}
    <div class="post-meta my-3 d-flex flex-wrap gap-3">
        <span><i class="fas fa-user" style="color:#764ba2;"></i> {{ $post->user->name ?? 'Admin' }}</span>
        <span><i class="fas fa-calendar-alt" style="color:#764ba2;"></i> {{ $post->created_at->format('M d, Y') }}</span>
        <span><i class="fas fa-comments" style="color:#764ba2;"></i> {{ $post->comments->count() }} Comments</span>
        <span><i class="fas fa-clock" style="color:#764ba2;"></i> {{ ceil(str_word_count($post->body) / 200) }} min read</span>
    </div>

    <hr style="border-color: #f0e6ff;">

    {{-- Body --}}
    <div class="post-body mt-4 mb-5">{{ $post->body }}</div>

    {{-- Share Buttons --}}
    <div class="p-4 mb-5" style="background: linear-gradient(135deg, #f8f9ff, #fff0f6); border-radius: 16px;">
        <h6 style="color: #764ba2; font-weight: 700; margin-bottom: 15px;"><i class="fas fa-share-alt"></i> Share this Story</h6>
        <div class="d-flex gap-2 flex-wrap">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-sm" style="background:#1877f2; color:white; border-radius:20px;">
                <i class="fab fa-facebook-f"></i> Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-sm" style="background:#1da1f2; color:white; border-radius:20px;">
                <i class="fab fa-twitter"></i> Twitter
            </a>
            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="btn btn-sm" style="background:#25d366; color:white; border-radius:20px;">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-sm" style="background:#0077b5; color:white; border-radius:20px;">
                <i class="fab fa-linkedin"></i> LinkedIn
            </a>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="d-flex gap-2 mb-5 flex-wrap">
        <a href="/" class="btn btn-outline-custom"><i class="fas fa-arrow-left"></i> Back</a>
        @auth
            <a href="/posts/{{ $post->slug }}/edit" class="btn btn-primary-custom"><i class="fas fa-edit"></i> Edit</a>
            <form action="/posts/{{ $post->slug }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-pink" onclick="return confirm('Delete this post?')">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        @endauth
    </div>

    {{-- Related Posts --}}
    @if($relatedPosts->count() > 0)
    <div class="mb-5">
        <h4 class="section-title mb-4"><i class="fas fa-book-open"></i> Related Stories</h4>
        <div class="row">
            @foreach($relatedPosts as $related)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        @if($related->image)
                            <img src="{{ $related->image }}" class="post-image" alt="{{ $related->title }}">
                        @else
                            <div class="post-placeholder">
                                <i class="fas fa-feather-alt fa-2x text-white opacity-75"></i>
                            </div>
                        @endif
                        <div class="card-body p-3">
                            <h6 class="card-title">
                                <a href="/posts/{{ $related->slug }}">{{ Str::limit($related->title, 40) }}</a>
                            </h6>
                            <small class="text-muted">{{ $related->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Comments Section --}}
    <div class="pt-4" style="border-top: 2px solid #f0e6ff;">
        <h4 class="section-title mb-4">
            <i class="fas fa-comments"></i> Comments ({{ $post->comments->count() }})
        </h4>

        @auth
        <form action="/comments" method="POST" class="mb-5">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-3">
                <label class="form-label">Share your thoughts...</label>
                <textarea name="body" class="form-control" rows="4" placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary-custom px-4">
                <i class="fas fa-paper-plane"></i> Post Comment
            </button>
        </form>
        @else
            <div class="alert" style="background: linear-gradient(135deg, #f8f9ff, #fff0f6); border: 1px solid #e8e0f5; border-radius: 12px; color: #764ba2;">
                <i class="fas fa-lock"></i> Please <a href="/login" style="color:#764ba2; font-weight:700;">login</a> to post a comment.
            </div>
        @endauth

        @forelse($post->comments as $comment)
            <div class="comment-box">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="comment-author"><i class="fas fa-user-circle"></i> {{ $comment->user->name }}</span>
                    <small class="text-muted">{{ $comment->created_at->format('M d, Y') }}</small>
                </div>
                <p class="mb-0" style="color:#444;">{{ $comment->body }}</p>
            </div>
        @empty
            <div class="text-center py-4">
                <i class="fas fa-comment-slash fa-2x mb-2" style="color:#e8e0f5;"></i>
                <p class="text-muted">No comments yet. Be the first to share!</p>
            </div>
        @endforelse
    </div>

</div>
@endsection