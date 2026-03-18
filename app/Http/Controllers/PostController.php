<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

   public function index(Request $request)
{
    $query = Post::with(['category', 'user', 'comments']);

    // Search
    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('body', 'like', '%' . $request->search . '%');
        });
    }

    // Sort
    if ($request->sort == 'oldest') {
        $query->oldest();
    } else {
        $query->latest();
    }

    // Filter by category
    if ($request->category) {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    $posts = $query->get();
    $categories = \App\Models\Category::all();
    return view('posts.index', compact('posts', 'categories'));
}

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body'  => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageData = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = 'data:' . $image->getMimeType() . ';base64,' . base64_encode(file_get_contents($image->getRealPath()));
        }

        Post::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . time(),
            'body'        => $request->body,
            'image'       => $imageData,
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        return redirect('/')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
{
    $post->load(['category', 'user', 'comments.user']);
    $relatedPosts = Post::where('id', '!=', $post->id)
        ->where('category_id', $post->category_id)
        ->latest()
        ->take(3)
        ->get();
    return view('posts.show', compact('post', 'relatedPosts'));
}

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body'  => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageData = $post->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = 'data:' . $image->getMimeType() . ';base64,' . base64_encode(file_get_contents($image->getRealPath()));
        }

        $post->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . time(),
            'body'        => $request->body,
            'image'       => $imageData,
            'category_id' => $request->category_id,
        ]);

        return redirect('/posts/' . $post->slug)->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/')->with('success', 'Post deleted successfully!');
    }
}