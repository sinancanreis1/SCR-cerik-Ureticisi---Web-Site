<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(9);
        return Inertia::render('Blog/Index', [
            'blogs' => $blogs
        ]);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        
        // Increment views
        $blog->increment('views');
        
        $recentBlogs = Blog::where('id', '!=', $blog->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            
        return Inertia::render('Blog/Show', [
            'blog' => $blog,
            'recentBlogs' => $recentBlogs
        ]);
    }
}
