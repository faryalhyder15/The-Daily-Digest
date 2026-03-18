<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalPosts    = Post::count();
        $totalUsers    = User::count();
        $totalComments = 0;
        $latestPosts   = Post::with('user')->latest()->take(5)->get();
        $latestUsers   = User::latest()->take(5)->get();

        return view('admin.index', compact(
            'totalPosts',
            'totalUsers',
            'totalComments',
            'latestPosts',
            'latestUsers'
        ));
    }

    public function deleteUser(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Delete user's posts first (if no cascade set in DB)
        $user->posts()->delete();

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}