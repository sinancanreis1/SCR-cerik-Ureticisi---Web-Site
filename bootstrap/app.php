<?php

namespace Illuminate\Support {
    if (!function_exists('Illuminate\Support\extension_loaded')) {
        function extension_loaded($name) {
            if ($name === 'intl') return true;
            return \extension_loaded($name);
        }
    }
}

namespace {
    if (!class_exists('NumberFormatter')) {
        class NumberFormatter {
            public const DECIMAL = 1;
            public const CURRENCY = 2;
            public const PERCENT = 3;
            public const SCIENTIFIC = 4;
            public const SPELLOUT = 5;
            public const ORDINAL = 6;
            public const DURATION = 7;
            public const PATTERN_DECIMAL = 8;
            public const PATTERN_RULEBASED = 9;
            public const IGNORE = 0;
            public const DEFAULT_STYLE = 1;

            public const MAX_FRACTION_DIGITS = 1;
            public const MIN_FRACTION_DIGITS = 2;

            public function __construct($locale, $style) {}
            public function format($value) { return $value; }
            public function formatCurrency($value, $currency) { return $value . ' ' . $currency; }
            public function setAttribute($attr, $val) {}
        }
    }
}

namespace {
    use Illuminate\Foundation\Application;
    use Illuminate\Foundation\Configuration\Exceptions;
    use Illuminate\Foundation\Configuration\Middleware;
    use Illuminate\Http\Request;

    return Application::configure(basePath: dirname(__DIR__))
        ->withRouting(
            web: __DIR__.'/../routes/web.php',
            commands: __DIR__.'/../routes/console.php',
            health: '/up',
        )
        ->withMiddleware(function (Middleware $middleware): void {
            $middleware->web(append: [
                \App\Http\Middleware\HandleInertiaRequests::class,
                \App\Http\Middleware\TrackPageVisits::class,
            ]);
        })
        ->withExceptions(function (Exceptions $exceptions): void {
            $exceptions->shouldRenderJsonWhen(
                fn (Request $request) => $request->is('api/*'),
            );
        })->create();
}
