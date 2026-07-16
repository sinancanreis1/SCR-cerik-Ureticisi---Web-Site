<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Yalnızca GET isteklerini ve admin paneli DIŞINDAKİ istekleri takip et
        // Inertia sayfa geçişleri de ajax (XHR) olduğu için onları da sayması için ajax kısıtlamasını kaldırıyoruz
        if ($request->isMethod('get') && !$request->is('admin*') && !$request->is('api*') && !$request->is('livewire*')) {
            \App\Models\PageVisit::create([
                'url' => $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
