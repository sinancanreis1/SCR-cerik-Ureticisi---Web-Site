<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = [
            'İşitme Cihazı Uygulama' => [
                'Şarjlı İşitme Cihazları',
                'Kablosuz İşitme Cihazları',
                'Kanal İçi Görünmez Cihazlar'
            ],
            'Pediatrik İşitme Uygulama' => [
                'Çocuklar İçin İşitme Testleri',
                'Çocuk İşitme Cihazları'
            ],
            'Tinnitus (Çınlama) Terapi' => [
                'Tinnitus Nedir?',
                'Tinnitus Tedavi Yöntemleri'
            ],
            'Cihaz Pil ve Aksesuarları' => [
                'İşitme Cihazı Pilleri',
                'Temizlik ve Bakım Ürünleri'
            ],
            'Profesyonel Odyolojik Test' => [
                'Yetişkin İşitme Testleri',
                'Odyolojik Değerlendirme'
            ],
            'SGK Desteği' => [
                'SGK İşitme Cihazı Ödemeleri',
                'Rapor ve Reçete İşlemleri'
            ],
            'İşitme Cihazı Tamir ve Bakım' => [
                'Teknik Servis',
                'Periyodik Bakım'
            ]
        ];

        foreach ($categoriesData as $parentName => $children) {
            $parent = Category::create([
                'name' => $parentName,
                'slug' => Str::slug($parentName),
                'description' => "Samsun Şehir İşitme Cihazları olarak $parentName konusunda size en iyi hizmeti sunuyoruz. Uzman odyologlarımız eşliğinde size uygun çözümleri keşfedin.",
            ]);

            foreach ($children as $childName) {
                Category::create([
                    'name' => $childName,
                    'slug' => Str::slug($childName),
                    'parent_id' => $parent->id,
                    'description' => "$childName hakkında detaylı bilgi ve profesyonel destek almak için Şehir İşitme Cihazları'na başvurabilirsiniz. Sağlığınız bizim için değerli.",
                ]);
            }
        }
    }
}
