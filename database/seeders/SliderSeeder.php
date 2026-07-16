<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        Slider::create([
            'title' => 'En Yeni Nesil İşitme Teknolojileri',
            'subtitle' => 'Hayatın seslerini kristal netliğinde duymak için tasarlanmış yüksek teknoloji cihazlarla tanışın.',
            'image_path' => '/images/hero_slider_1.png',
            'button_text' => 'Cihazları İncele',
            'button_link' => '#kategoriler',
            'order' => 1
        ]);

        Slider::create([
            'title' => 'Duyduğunuz Her An Değerli',
            'subtitle' => 'Sevdiklerinizin sesinden uzak kalmayın. Samsun Şehir İşitme Cihazları ile sosyal hayatınıza tam katılım sağlayın.',
            'image_path' => '/images/hero_slider_2.png',
            'button_text' => 'Randevu Alın',
            'button_link' => '#iletisim',
            'order' => 2
        ]);
    }
}
