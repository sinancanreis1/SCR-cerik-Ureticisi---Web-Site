<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Product;

class InteractionController extends Controller
{
    protected function hasProfanity($text)
    {
        $blacklist = [
            'amcık', 'göt', 'piç', 'orospu', 'sik', 'sikiş', 'yarrak', 'pezevenk', 'kahpe', 
            'kancık', 'meme', 'taşşak', 'gavat', 'ibne', 'amına', 'koyayım', 'sikerim', 
            'fuck', 'asshole', 'bitch', 'o.ç', 'oç', 'götveren', 'şerefsiz', 'salak', 'aptal'
        ];
        
        $text = mb_strtolower($text, 'UTF-8');
        
        foreach ($blacklist as $badWord) {
            if (str_contains($text, $badWord)) {
                return true;
            }
        }
        return false;
    }

    public function toggleLike(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $user = Auth::user();

        if ($user) {
            $like = $blog->likes()->where('user_id', $user->id)->first();
        } else {
            $like = $blog->likes()->whereNull('user_id')->where('ip_address', $request->ip())->first();
        }

        if ($like) {
            $like->delete();
            return back()->with('success', 'Beğeni kaldırıldı.');
        } else {
            $blog->likes()->create([
                'user_id' => $user ? $user->id : null,
                'ip_address' => $request->ip(),
            ]);
            return back()->with('success', 'İçerik beğenildi.');
        }
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        if ($this->hasProfanity($request->content)) {
            return back()->withErrors(['content' => 'Yorumunuz uygunsuz/argo kelimeler içermektedir.'])->withInput();
        }

        $blog = Blog::findOrFail($id);
        
        $blog->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'is_approved' => false
        ]);

        return back()->with('success', 'Yorumunuz alındı, yönetici onayından sonra yayınlanacaktır.');
    }

    public function toggleProductLike(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();

        if ($user) {
            $like = $product->likes()->where('user_id', $user->id)->first();
        } else {
            $like = $product->likes()->whereNull('user_id')->where('ip_address', $request->ip())->first();
        }

        if ($like) {
            $like->delete();
            return back()->with('success', 'Beğeni kaldırıldı.');
        } else {
            $product->likes()->create([
                'user_id' => $user ? $user->id : null,
                'ip_address' => $request->ip(),
            ]);
            return back()->with('success', 'Proje beğenildi.');
        }
    }

    public function storeProductComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        if ($this->hasProfanity($request->content)) {
            return back()->withErrors(['content' => 'Yorumunuz uygunsuz/argo kelimeler içermektedir.'])->withInput();
        }

        $product = Product::findOrFail($id);
        
        $product->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'is_approved' => false
        ]);

        return back()->with('success', 'Yorumunuz alındı, yönetici onayından sonra yayınlanacaktır.');
    }
}
