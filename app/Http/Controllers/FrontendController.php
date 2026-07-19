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
        
        if (!empty($siteSetting->home_selected_blog_categories)) {
            $blogs = Blog::whereIn('category', $siteSetting->home_selected_blog_categories)->latest()->take(3)->get();
        } else {
            $blogs = Blog::latest()->take(3)->get();
        }

        if (!empty($siteSetting->home_selected_product_categories)) {
            $products = Product::whereIn('category', $siteSetting->home_selected_product_categories)->latest()->take(4)->get();
        } else {
            $products = Product::latest()->take(4)->get();
        }
        
        return view('frontend.index', compact('siteSetting', 'blogs', 'products'));
    }

    public function icerikler()
    {
        $siteSetting = SiteSetting::first();
        $blogs = Blog::latest()->get(); // All blogs for this page
        return view('frontend.icerikler', compact('siteSetting', 'blogs'));
    }

    public function projelerim()
    {
        $siteSetting = SiteSetting::first();
        $products = Product::latest()->get(); // All projects for this page
        return view('frontend.projelerim', compact('siteSetting', 'products'));
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
