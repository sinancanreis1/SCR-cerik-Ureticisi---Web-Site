<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $props = $page['props'] ?? [];
            $rawTitle = $props['pageTitle'] ?? ($props['product']['title'] ?? $props['product']['name'] ?? '') ?? ($props['currentCategory']['name'] ?? '') ?? ($props['blog']['title'] ?? '');
            $title = $rawTitle ? $rawTitle . ' - ' . config('app.name', 'Sinan Can REİS') : config('app.name', 'Sinan Can REİS');
            $desc = $props['pageDescription'] ?? ($props['product']['desc'] ?? '') ?? ($props['blog']['excerpt'] ?? '') ?? 'Yazılım, Yapay Zeka ve Dijital Tasarım Uzmanı - Sinan Can REİS kişisel portfolyo ve blog sitesi.';
        @endphp
        <title inertia>{{ $title }}</title>
        <meta name="description" content="{{ $desc }}">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/logo.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/logo.png">
        <link rel="shortcut icon" href="/images/logo.png">
        <meta name="theme-color" content="#00BCD4">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
        
        <!-- Icons -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
