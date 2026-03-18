@extends('layouts.app')
@section('title', 'Manage Users')
@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title"><i class="fas fa-users"></i> Manage Users</h2>
        <a href="/admin" class="btn btn-outline-custom"><i class="fas fa-arrow-left"></i> Dashboard</a>
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
                        <th style="color: #764ba2;">Name</th>
                        <th style="color: #764ba2;">Email</th>
                        <th style="color: #764ba2;">Posts</th>
                        <th style="color: #764ba2;">Joined</th>
                        <th style="color: #764ba2;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="border-bottom: 1px solid #f0e6ff;">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="background: linear-gradient(135deg, #667eea, #f093fb); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user text-white" style="font-size:0.8rem;"></i>
                                    </div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td><i class="fas fa-pen-nib" style="color:#764ba2;"></i> {{ $user->posts_count }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($user->id !== auth()->id())
                                    <form action="/admin/users/{{ $user->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-pink btn-sm" onclick="return confirm('Delete this user and all their posts?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @else
                                    <span class="badge-category">You</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection