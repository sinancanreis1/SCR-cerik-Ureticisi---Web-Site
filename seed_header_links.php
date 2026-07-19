<?php

use App\Models\HeaderLink;

// Sadece tablo boşsa ekleme yapalım
if (HeaderLink::count() === 0) {
    $links = [
        ['label' => 'Ana Sayfa', 'url' => '/', 'sort_order' => 1, 'is_active' => true],
        ['label' => 'İçerikler', 'url' => '/icerikler', 'sort_order' => 2, 'is_active' => true],
        ['label' => 'Projelerim', 'url' => '/projelerim', 'sort_order' => 3, 'is_active' => true],
        ['label' => 'Hakkımda', 'url' => '/hakkimda', 'sort_order' => 4, 'is_active' => true],
        ['label' => 'İletişim', 'url' => '/iletisim', 'sort_order' => 5, 'is_active' => true],
    ];

    foreach ($links as $link) {
        HeaderLink::create($link);
    }
    echo "Header links seeded successfully.\n";
} else {
    echo "Header links already exist.\n";
}
