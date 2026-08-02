<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Banlı kullanıcıyı engelle
            if (Auth::user()->is_banned) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Hesabınız askıya alınmıştır. Lütfen yönetici ile iletişime geçin.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect()->intended('/profilim');
        }

        return back()->withErrors([
            'email' => 'Sağlanan kimlik bilgileri kayıtlarımızla eşleşmiyor.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('frontend.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('üye');

        Auth::login($user);

        return redirect('/profilim');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
