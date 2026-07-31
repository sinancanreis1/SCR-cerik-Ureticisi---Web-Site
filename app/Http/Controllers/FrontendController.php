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
        $blogs = Blog::latest()->take(4)->get();
        $products = Product::latest()->take(3)->get();
        
        return view('frontend.index', compact('siteSetting', 'blogs', 'products'));
    }

    public function icerikler()
    {
        $siteSetting = SiteSetting::first();
        $blogs = Blog::latest()->get(); // All blogs for this page
        return view('frontend.icerikler', compact('siteSetting', 'blogs'));
    }

    public function icerikDetay($slug)
    {
        $siteSetting = SiteSetting::first();
        $blog = Blog::where('slug', $slug)->firstOrFail();
        
        // Increment views
        $blog->increment('views');

        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->take(3)
            ->get();

        if ($relatedBlogs->isEmpty()) {
            $relatedBlogs = Blog::where('id', '!=', $blog->id)->take(3)->get();
        }

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
