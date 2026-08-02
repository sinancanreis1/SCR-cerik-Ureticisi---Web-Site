<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Blog;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $blogs = $user->blogs()->latest()->get();
        $comments = $user->comments()->with('commentable')->latest()->get();
        $likes = $user->likes()->with('likeable')->latest()->get();

        return view('frontend.profile.index', compact('user', 'blogs', 'comments', 'likes'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $data = [
            'name'        => $request->name,
            'email'       => $request->email,
            'title'       => $request->title,
            'description' => $request->description,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_url'] = $avatarPath;
        }

        $user->update($data);

        return redirect()->route('profile.index')->with('success', 'Profiliniz başarıyla güncellendi.');
    }

    public function createPost()
    {
        return view('frontend.profile.create-post');
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'excerpt'  => 'nullable|string',
            'content'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $slug = Str::slug($request->title);
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        Auth::user()->blogs()->create([
            'title'      => $request->title,
            'category'   => $request->category,
            'slug'       => $slug,
            'excerpt'    => $request->excerpt,
            'content'    => $request->content,
            'image_path' => $imagePath,
            'is_active'  => false
        ]);

        return redirect()->route('profile.index')->with('success', 'Yazınız başarıyla gönderildi. Yönetici onayından sonra yayınlanacaktır.');
    }
}
