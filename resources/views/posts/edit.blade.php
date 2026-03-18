@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container mt-5" style="max-width: 750px;">
    <div class="auth-card">
        <h2 class="auth-title"><i class="fas fa-edit"></i> Edit Your Story</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p class="mb-0"><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Cover Image</label>
                @if($post->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $post->image) }}" style="height: 150px; object-fit: cover; border-radius: 10px; width: 100%;">
                    </div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current image</small>
            </div>
            <div class="mb-4">
                <label class="form-label">Your Story</label>
                <textarea name="body" class="form-control" rows="10" required>{{ $post->body }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warm px-5">
                    <i class="fas fa-save"></i> Update Story
                </button>
                <a href="/posts/{{ $post->slug }}" class="btn btn-outline-warm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection