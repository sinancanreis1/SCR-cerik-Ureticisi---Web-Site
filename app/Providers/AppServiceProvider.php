<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || request()->secure() || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        try {
            \Illuminate\Support\Facades\View::share(
                'headerLinks',
                \App\Models\HeaderLink::where('is_active', true)->orderBy('sort_order')->get()
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\View::share('headerLinks', collect([]));
        }
    }
}
