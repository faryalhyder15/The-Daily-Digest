@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
<div class="container mt-5" style="max-width: 750px;">
    <div class="auth-card">
        <h2 class="auth-title"><i class="fas fa-pen-nib"></i> Write New Story</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p class="mb-0"><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter your story title..." value="{{ old('title') }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Cover Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Optional. Max size: 2MB</small>
            </div>
            <div class="mb-4">
                <label class="form-label">Your Story</label>
                <textarea name="body" class="form-control" rows="10" placeholder="Share your thoughts..." required>{{ old('body') }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warm px-5">
                    <i class="fas fa-paper-plane"></i> Publish Story
                </button>
                <a href="/" class="btn btn-outline-warm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection