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
            ['label' => 'İşitme Cihazı Uygulama', 'url' => '/hizmetler/isitme-cihazi-uygulama', 'sort_order' => 1],
            ['label' => 'Pediatrik İşitme Uygulama', 'url' => '/hizmetler/pediatrik-isitme-uygulama', 'sort_order' => 2],
            ['label' => 'Tinnitus (Çınlama) Terapi', 'url' => '/hizmetler/tinnitus-cinlama-terapi', 'sort_order' => 3],
            ['label' => 'Cihaz Pil ve Aksesuarları', 'url' => '/hizmetler/cihaz-pil-ve-aksesuarlari', 'sort_order' => 4],
            ['label' => 'Profesyonel Odyolojik Test', 'url' => '/hizmetler/profesyonel-odyolojik-test', 'sort_order' => 5],
            ['label' => 'SGK Desteği', 'url' => '/hizmetler/sgk-destegi', 'sort_order' => 6],
        ];

        foreach ($services as $link) {
            FooterLink::firstOrCreate(
                ['url' => $link['url'], 'column' => 'services'],
                ['label' => $link['label'], 'sort_order' => $link['sort_order'], 'is_active' => true]
            );
        }
    }
}
