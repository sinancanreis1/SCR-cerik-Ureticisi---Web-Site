<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $setting = SiteSetting::first();
        $toEmail = $setting->contact_email ?? $setting->email ?? 'info@sinancanreis.com';

        try {
            Mail::to($toEmail)->send(new ContactFormMail($data));
            return back()->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağım.');
        } catch (\Exception $e) {
            \Log::error('Mail Error: ' . $e->getMessage());
            return back()->with('error', 'Mesaj gönderilirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
        }
    }
}

