<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Blog;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();
        $blogs = Blog::where('is_active', true)->latest()->take(4)->get();
        $products = Product::latest()->take(3)->get();
        
        return view('frontend.index', compact('siteSetting', 'blogs', 'products'));
    }

    public function icerikler()
    {
        $siteSetting = SiteSetting::first();
        $blogs = Blog::where('is_active', true)->latest()->get(); // Only approved blogs
        return view('frontend.icerikler', compact('siteSetting', 'blogs'));
    }

    public function icerikDetay($slug)
    {
        $siteSetting = SiteSetting::first();
        
        // Show post if it's active, or if the logged-in user is the author
        $blog = Blog::where('slug', $slug)
            ->where(function ($query) {
                $query->where('is_active', true)
                    ->orWhere('user_id', auth()->id());
            })
            ->firstOrFail();
        
        // Increment views
        $blog->increment('views');

        $relatedBlogs = Blog::where('is_active', true)
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->take(3)
            ->get();

        return view('frontend.icerik-detay', compact('siteSetting', 'blog', 'relatedBlogs'));
    }

    public function projelerim()
    {
        $siteSetting = SiteSetting::first();
        $products = Product::latest()->get(); // All projects for this page
        return view('frontend.projelerim', compact('siteSetting', 'products'));
    }

    public function projeDetay($slug)
    {
        $siteSetting = SiteSetting::first();
        $product = Product::where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('frontend.proje-detay', compact('siteSetting', 'product', 'relatedProducts'));
    }

    public function hakkimda()
    {
        $siteSetting = SiteSetting::first();
        return view('frontend.hakkimda', compact('siteSetting'));
    }

    public function iletisim()
    {
        $siteSetting = SiteSetting::first();
        return view('frontend.iletisim', compact('siteSetting'));
    }
}
