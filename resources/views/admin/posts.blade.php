@extends('layouts.app')
@section('title', 'Manage Posts')
@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title"><i class="fas fa-pen-nib"></i> Manage Posts</h2>
        <div class="d-flex gap-2">
            <a href="/admin" class="btn btn-outline-custom"><i class="fas fa-arrow-left"></i> Dashboard</a>
            <a href="/posts/create" class="btn btn-primary-custom"><i class="fas fa-plus"></i> New Post</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table" style="color: #2d2d4e;">
                <thead>
                    <tr style="border-bottom: 2px solid #f0e6ff;">
                        <th style="color: #764ba2;">#</th>
                        <th style="color: #764ba2;">Title</th>
                        <th style="color: #764ba2;">Author</th>
                        <th style="color: #764ba2;">Category</th>
                        <th style="color: #764ba2;">Comments</th>
                        <th style="color: #764ba2;">Date</th>
                        <th style="color: #764ba2;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr style="border-bottom: 1px solid #f0e6ff;">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="/posts/{{ $post->slug }}" style="color: #764ba2; text-decoration: none;">
                                    {{ Str::limit($post->title, 30) }}
                                </a>
                            </td>
                            <td>{{ $post->user->name ?? 'Admin' }}</td>
                            <td>
                                @if($post->category)
                                    <span class="badge-category">{{ $post->category->name }}</span>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td><i class="fas fa-comments" style="color:#764ba2;"></i> {{ $post->comments->count() }}</td>
                            <td>{{ $post->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="/posts/{{ $post->slug }}/edit" class="btn btn-outline-custom btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/admin/posts/{{ $post->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-pink btn-sm" onclick="return confirm('Delete this post?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection