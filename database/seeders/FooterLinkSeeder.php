<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FooterLink;

class FooterLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quickLinks = [
            ['label' => 'Ana Sayfa', 'url' => '/', 'sort_order' => 1],
            ['label' => 'Hakkımızda', 'url' => '/hakkimizda', 'sort_order' => 2],
            ['label' => 'Ürünler', 'url' => '/urunler', 'sort_order' => 3],
            ['label' => 'Hizmetlerimiz', 'url' => '/hizmetlerimiz', 'sort_order' => 4],
            ['label' => 'İletişim & Randevu Al', 'url' => '/iletisim', 'sort_order' => 5],
        ];

        foreach ($quickLinks as $link) {
            FooterLink::firstOrCreate(
                ['url' => $link['url'], 'column' => 'quick_links'],
                ['label' => $link['label'], 'sort_order' => $link['sort_order'], 'is_active' => true]
            );
        }

        $services = [
            ['label' => 'Bilişim Dünyası', 'url' => '/hizmetler/bilisim', 'sort_order' => 1],
            ['label' => 'Yazılım & Geliştirme', 'url' => '/hizmetler/yazilim', 'sort_order' => 2],
            ['label' => 'Teknoloji Haberleri', 'url' => '/hizmetler/teknoloji', 'sort_order' => 3],
            ['label' => 'Bilim & İnovasyon', 'url' => '/hizmetler/bilim', 'sort_order' => 4],
            ['label' => 'Yapay Zeka (AI)', 'url' => '/hizmetler/yapay-zeka', 'sort_order' => 5],
            ['label' => 'Dijital Gelişim', 'url' => '/hizmetler/dijital-gelisim', 'sort_order' => 6],
        ];

        foreach ($services as $link) {
            FooterLink::firstOrCreate(
                ['url' => $link['url'], 'column' => 'services'],
                ['label' => $link['label'], 'sort_order' => $link['sort_order'], 'is_active' => true]
            );
        }
    }
}
