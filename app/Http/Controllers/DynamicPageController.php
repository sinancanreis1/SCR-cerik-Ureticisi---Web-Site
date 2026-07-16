<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DynamicPageController extends Controller
{
    public function index($slug)
    {
        // Bulunan sayfayı is_dynamic_page ve is_active olarak ara
        $headerLink = \App\Models\HeaderLink::where('url', $slug)
            ->orWhere('url', '/' . $slug)
            ->where('is_dynamic_page', true)
            ->where('is_active', true)
            ->firstOrFail();

        $items = \App\Models\DynamicItem::where('header_link_id', $headerLink->id)
            ->active()
            ->ordered()
            ->get();

        if ($headerLink->page_template === 'services') {
            // Services template expects 'categories' mapped like Category model where each has 'children'
            $mappedCategories = [
                [
                    'id' => $headerLink->id,
                    'name' => $headerLink->page_title ?: $headerLink->label,
                    'slug' => ltrim($headerLink->url, '/'),
                    'description' => $headerLink->page_description,
                    'image' => null,
                    'children' => $items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->title,
                            'slug' => $item->slug,
                            'description' => $item->short_description,
                            'image' => $item->image,
                        ];
                    })->toArray()
                ]
            ];
            return Inertia::render('Services', [
                'categories' => $mappedCategories,
                'pageTitle' => $headerLink->page_title ?: $headerLink->label,
                'pageDescription' => $headerLink->page_description,
                'baseUrl' => '/' . ltrim($headerLink->url, '/')
            ]);
        }

        if ($headerLink->page_template === 'products') {
            // Products template expects 'products' and optionally 'categories'
            $mappedProducts = $items->map(function ($item) use ($headerLink) {
                return [
                    'id' => $item->id,
                    'name' => $item->title,
                    'slug' => $item->slug,
                    'description' => $item->short_description,
                    'image_url' => $item->image ? '/storage/' . $item->image : null,
                    'category' => ['name' => $headerLink->page_title ?: $headerLink->label, 'slug' => $headerLink->url]
                ];
            });
            return Inertia::render('Products', [
                'products' => $mappedProducts,
                'categories' => [], // Dynamic pages probably don't have nested categories yet
                'currentCategory' => null,
                'search' => null,
                'pageTitle' => $headerLink->page_title ?: $headerLink->label,
                'pageDescription' => $headerLink->page_description,
                'baseUrl' => '/' . ltrim($headerLink->url, '/')
            ]);
        }

        if ($headerLink->page_template === 'blog') {
            // Blog template expects paginated 'blogs'
            $mappedBlogs = \App\Models\DynamicItem::where('header_link_id', $headerLink->id)
                ->active()
                ->ordered()
                ->paginate(9);

            $mappedBlogs->getCollection()->transform(function ($item) use ($headerLink) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'excerpt' => $item->short_description,
                    'image' => $item->image,
                    'published_at' => $item->created_at->format('d M Y'),
                    'category' => ['name' => $headerLink->page_title ?: $headerLink->label]
                ];
            });

            return Inertia::render('Blog/Index', [
                'blogs' => $mappedBlogs,
                'search' => null,
                'pageTitle' => $headerLink->page_title ?: $headerLink->label,
                'pageDescription' => $headerLink->page_description,
                'baseUrl' => '/' . ltrim($headerLink->url, '/')
            ]);
        }

        abort(404);
    }

    public function show($categorySlug, $itemSlug)
    {
        $headerLink = \App\Models\HeaderLink::where('url', $categorySlug)
            ->orWhere('url', '/' . $categorySlug)
            ->where('is_dynamic_page', true)
            ->where('is_active', true)
            ->firstOrFail();

        $item = \App\Models\DynamicItem::where('header_link_id', $headerLink->id)
            ->where('slug', $itemSlug)
            ->active()
            ->firstOrFail();

        if ($headerLink->page_template === 'services') {
            // Format for Category/Show
            $formattedCategory = [
                'id' => $item->id,
                'name' => $item->title,
                'slug' => $item->slug,
                'description' => $item->content,
                'image' => $item->image,
                'features_title' => $item->features_title ?: '',
                'features' => $item->features ?: [],
                'bottom_description' => $item->bottom_description ?: '',
                'parent_id' => $headerLink->id,
                'parent' => [
                    'id' => $headerLink->id,
                    'name' => $headerLink->page_title ?: $headerLink->label,
                    'slug' => ltrim($headerLink->url, '/')
                ],
                'children' => []
            ];
            
            $siblings = \App\Models\DynamicItem::where('header_link_id', $headerLink->id)
                ->active()
                ->ordered()
                ->get()
                ->map(function ($b) {
                    return [
                        'id' => $b->id,
                        'name' => $b->title,
                        'slug' => $b->slug
                    ];
                });

            return Inertia::render('Category/Show', [
                'categories' => [], // Add categories if needed by layout
                'currentCategory' => $formattedCategory,
                'siblings' => $siblings,
                'baseUrl' => '/' . ltrim($headerLink->url, '/')
            ]);
        }

        if ($headerLink->page_template === 'products') {
            // Format for ProductDetail
            $formattedProduct = [
                'id' => $item->id,
                'name' => $item->title,
                'title' => $item->title, // Add title to prevent undefined errors
                'description' => $item->content,
                'desc' => $item->short_description,
                'long_desc' => $item->content,
                'image_url' => $item->image ? '/storage/' . $item->image : null,
                'image' => $item->image,
                'features' => [],
                'category' => ['name' => $headerLink->label, 'slug' => $headerLink->url]
            ];
            return Inertia::render('ProductDetail', [
                'categories' => [],
                'product' => $formattedProduct,
                'baseUrl' => '/' . ltrim($headerLink->url, '/')
            ]);
        }

        if ($headerLink->page_template === 'blog') {
            // Format for Blog/Show
            $formattedBlog = [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'content' => $item->content,
                'excerpt' => $item->short_description,
                'image' => $item->image,
                'image_path' => $item->image,
                'published_at' => $item->created_at->format('d.m.Y'),
                'created_at' => $item->created_at,
                'views' => 0,
                'author' => ['name' => 'Admin'],
                'category' => ['name' => $headerLink->label, 'slug' => $headerLink->url]
            ];
            
            $recentBlogs = \App\Models\DynamicItem::where('header_link_id', $headerLink->id)
                ->active()
                ->where('id', '!=', $item->id)
                ->ordered()
                ->take(3)
                ->get()
                ->map(function ($b) {
                    return [
                        'id' => $b->id,
                        'title' => $b->title,
                        'slug' => $b->slug,
                        'image' => $b->image,
                        'image_path' => $b->image,
                        'created_at' => $b->created_at,
                        'published_at' => $b->created_at->format('d.m.Y')
                    ];
                });

            return Inertia::render('Blog/Show', [
                'blog' => $formattedBlog,
                'recentBlogs' => $recentBlogs,
                'baseUrl' => '/' . ltrim($headerLink->url, '/')
            ]);
        }

        abort(404);
    }
}
