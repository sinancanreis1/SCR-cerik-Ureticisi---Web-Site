<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run()
    {
        // Clear existing records
        Blog::truncate();
        Product::truncate();

        // Create AI / Software Blogs
        $blogs = [
            [
                'title' => 'Yapay Zeka ile Kod Yazma Hızınızı %300 Artırın',
                'slug' => Str::slug('Yapay Zeka ile Kod Yazma Hızınızı 300 Artırın'),
                'excerpt' => 'Cursor, GitHub Copilot ve ChatGPT gibi araçları entegre ederek günlük yazılım süreçlerinizi nasıl hızlandırabilirsiniz?',
                'content' => '<p>Geliştirici ekosistemi hızla değişiyor...</p>',
            ],
            [
                'title' => 'Laravel 11: Yeni Özelliklere İlk Bakış',
                'slug' => Str::slug('Laravel 11 Yeni Özelliklere İlk Bakış'),
                'excerpt' => 'Daha hafif bir iskelet, basitleştirilmiş ayarlar ve yeni veritabanı sürücüleri ile Laravel 11 neler sunuyor?',
                'content' => '<p>Artık Http Kernel yok...</p>',
            ],
            [
                'title' => 'Sektörün Yeni Gözdesi: RAG (Retrieval-Augmented Generation)',
                'slug' => Str::slug('Sektorun Yeni Gozdesi RAG'),
                'excerpt' => 'Kendi şirket verilerinizle çalışan özel bir yapay zeka asistanı RAG mimarisi ile nasıl oluşturulur?',
                'content' => '<p>Büyük dil modellerinin hafıza problemini çözmenin yolu...</p>',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }

        // Create Software/Tech Projects
        $products = [
            [
                'title' => 'E-Ticaret Botu',
                'slug' => Str::slug('E-Ticaret Botu'),
                'subtitle' => 'Otomatik ürün fiyat takibi',
                'desc' => 'Yapay zeka destekli fiyat tahminleme ve otomatik güncelleme botu.',
            ],
            [
                'title' => 'SaaS Yönetim Paneli',
                'slug' => Str::slug('SaaS Yonetim Paneli'),
                'subtitle' => 'Laravel & Filament',
                'desc' => 'B2B şirketler için geliştirilmiş çoklu kiracı (multi-tenant) mimariye sahip ERP sistemi.',
            ],
            [
                'title' => 'Görüntü İşleme API',
                'slug' => Str::slug('Goruntu Isleme API'),
                'subtitle' => 'Python & FastAPI',
                'desc' => 'Yüz tanıma ve nesne tespiti yapabilen yüksek performanslı mikroservis.',
            ],
            [
                'title' => 'İçerik Üretici Portalı',
                'slug' => Str::slug('Icerik Uretici Portali'),
                'subtitle' => 'Dijital Gelişim',
                'desc' => 'İçerik üreticilerin istatistiklerini tek bir ekranda topladığı veri analiz platformu.',
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Update SiteSettings
        $setting = SiteSetting::first();
        if ($setting) {
            $setting->update([
                'home_mission_title' => 'Misyonumuz',
                'home_mission_text' => 'Karmaşık görünen teknolojik konseptleri herkesin anlayabileceği bir sadelikte sunarak dijital okuryazarlığı artırmak.',
                'home_vision_title' => 'Vizyonumuz',
                'home_vision_text' => 'Yazılım ve yapay zeka ekosisteminde Türkçe kaynak eksikliğini gidererek, teknoloji üreten bir topluluk oluşturmak.'
            ]);
        }
    }
}
