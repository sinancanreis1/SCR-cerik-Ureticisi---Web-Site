<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Product;

class InteractionController extends Controller
{
    public function toggleLike(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $user = Auth::user();

        $like = $blog->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            return back()->with('success', 'Beğeni kaldırıldı.');
        } else {
            $blog->likes()->create([
                'user_id' => $user->id,
            ]);
            return back()->with('success', 'İçerik beğenildi.');
        }
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $blog = Blog::findOrFail($id);
        
        $blog->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'is_approved' => true
        ]);

        return back()->with('success', 'Yorumunuz başarıyla eklendi.');
    }

    public function toggleProductLike(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();

        $like = $product->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            return back()->with('success', 'Beğeni kaldırıldı.');
        } else {
            $product->likes()->create([
                'user_id' => $user->id,
            ]);
            return back()->with('success', 'Proje beğenildi.');
        }
    }

    public function storeProductComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $product = Product::findOrFail($id);
        
        $product->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'is_approved' => true
        ]);

        return back()->with('success', 'Yorumunuz başarıyla eklendi.');
    }
}
