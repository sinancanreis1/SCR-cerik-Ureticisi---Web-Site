<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    private function getDynamicSectionData($type)
    {
        if (!$type) return [];
        
        if ($type === 'products') {
            return \App\Models\Product::latest()->take(6)->get();
        } elseif ($type === 'blogs') {
            return \App\Models\Blog::latest()->take(6)->get();
        } elseif ($type === 'categories') {
            return Category::whereNull('parent_id')->with('children')->take(6)->get();
        } elseif (str_starts_with($type, 'dynamic_')) {
            $headerLinkId = str_replace('dynamic_', '', $type);
            return \App\Models\DynamicItem::where('header_link_id', $headerLinkId)->orderBy('sort_order')->take(6)->get();
        }
        
        return [];
    }

    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $sliders = \App\Models\Slider::where('is_active', true)->orderBy('order')->get();
        $settings = \App\Models\SiteSetting::first();
        
        $section4Type = $settings?->home_section4_type ?? 'products';
        $section7Type = $settings?->home_section7_type ?? 'categories';

        return Inertia::render('Home', [
            'categories' => $categories,
            'sliders' => $sliders,
            'products' => $this->getProducts(),
            'section4Data' => $this->getDynamicSectionData($section4Type),
            'section4Type' => $section4Type,
            'section7Data' => $this->getDynamicSectionData($section7Type),
            'section7Type' => $section7Type,
        ]);
    }

    public function about()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $settings = \App\Models\SiteSetting::first();
        
        return Inertia::render('About', [
            'categories' => $categories,
            'settings' => $settings,
            'pageTitle' => 'Hakkımızda',
            'pageDescription' => strip_tags(substr($settings?->about_text ?? '', 0, 160))
        ]);
    }

    public function services()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return Inertia::render('Services', [
            'categories' => $categories,
            'pageTitle' => 'Hizmetlerimiz',
            'pageDescription' => 'Samsun Şehir İşitme Cihazları Merkezi olarak sunduğumuz odyolojik hizmetler ve cihaz uygulamaları.'
        ]);
    }

    private function getProducts()
    {
        return Product::all();
    }

    public function products()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return Inertia::render('Products', [
            'categories' => $categories,
            'products' => $this->getProducts()
        ]);
    }

    public function productShow($slug)
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        
        $product = Product::where('slug', $slug)->firstOrFail();

        return Inertia::render('ProductDetail', [
            'categories' => $categories,
            'product' => $product
        ]);
    }

    public function show($slug)
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $currentCategory = Category::where('slug', $slug)->with(['children', 'parent'])->firstOrFail();

        // Eğer bu bir ana kategoriyse ve alt kategorileri varsa, otomatik olarak ilk alt kategoriye yönlendir.
        // Bu sayede kullanıcı boş bir sayfa yerine doğrudan dolu bir içeriğe ulaşır (Dengeli yapı).
        if (is_null($currentCategory->parent_id) && $currentCategory->children->count() > 0) {
            return redirect('/hizmetler/' . $currentCategory->children->first()->slug);
        }

        // Eğer alt kategoriyse, kardeşlerini (aynı parent'a sahip olanları) bul
        $siblings = [];
        if ($currentCategory->parent_id) {
            $siblings = Category::where('parent_id', $currentCategory->parent_id)->get();
        }

        return Inertia::render('Category/Show', [
            'categories' => $categories,
            'currentCategory' => $currentCategory,
            'siblings' => $siblings,
            'pageTitle' => $currentCategory->name,
            'pageDescription' => strip_tags(substr($currentCategory->description ?? '', 0, 160))
        ]);
    }

    public function search(Request $request)
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        
        $query = $request->input('q');
        
        $results = [];
        if ($query) {
            $results = Category::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->get();
        }

        return Inertia::render('Search', [
            'categories' => $categories,
            'query' => $query,
            'results' => $results
        ]);
    }

    public function contact()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $settings = \App\Models\SiteSetting::first();
        return Inertia::render('Contact', [
            'categories' => $categories,
            'settings' => $settings,
            'pageTitle' => 'İletişim',
            'pageDescription' => 'Bize ulaşın. Samsun Şehir İşitme Cihazları Merkezi iletişim bilgileri ve harita.'
        ]);
    }

    public function submitContact(Request $request)
    {
        // Form verilerini doğrula
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:50',
            'city' => 'required|string',
            'message' => 'nullable|string',
        ]);

        // Gerçek bir sistemde bu veriler DB'ye kaydedilir veya mail atılır.
        // Şimdilik sadece başarılı mesajıyla geri döndürüyoruz.
        return back()->with('success', 'Mesajınız başarıyla alındı. En kısa sürede size dönüş yapacağız.');
    }
}
