<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                // ── İletişim Bilgileri ──────────────────────────────────
                'phone'            => '0(546) 978 93 55',
                'whatsapp_number'  => '905469789355',
                'email'            => 'Sehirisitme55@outlook.com.tr',
                'address'          => 'Samsun Canik, Türkiye',
                'map_url'          => '',

                // ── Sosyal Medya ────────────────────────────────────────
                'facebook_url'  => '',
                'instagram_url' => '',
                'twitter_url'   => '',
                'linkedin_url'  => '',

                // ── Site Genel Metinleri ─────────────────────────────────
                'home_about_title' => 'Hayatın Seslerine Yeniden Kavuşun',
                'home_about_text'  => 'Samsun Şehir İşitme Cihazları Satış ve Uygulama Merkezi olarak, 1 Mart 2026 tarihinde "Duyduğunuz Her An Değerli" mottosuyla yola çıktık.',
                'footer_about_text'=> 'Duyduğunuz her an değerli. Uzman kadromuzla, size en uygun işitme çözümlerini sunarak hayatınıza ses katıyoruz.',

                // ── Hakkımızda — Hero (Banner) ───────────────────────────
                'about_hero_image'    => null,
                'about_hero_subtitle' => 'Samsun Şehir İşitme Cihazları Merkezi',
                'about_hero_title'    => 'Hakkımızda',
                'about_hero_desc'     => '1 Mart 2026 tarihinde "Duyduğunuz Her An Değerli" mottosuyla yola çıkan güvenilir işitme sağlığı merkezi.',

                // ── Hakkımızda — Tanıtım Yazısı ─────────────────────────
                'about_intro_image'  => null,
                'about_intro_title'  => 'Hayatın Seslerine Yeniden Kavuşun',
                'about_intro_text_1' => 'Samsun Şehir İşitme Cihazları Satış ve Uygulama Merkezi olarak, 1 Mart 2026 tarihinde "Duyduğunuz Her An Değerli" mottosuyla yola çıktık. Samsun Canik\'te bulunan merkezimizde, işitme kaybı yaşayan bireylerin yaşam kalitesini artırmak ve onları hayata yeniden güçlü bağlarla bağlamak için modern ve bilimsel çözümler sunuyoruz.',
                'about_intro_text_2' => 'Sektördeki güncel teknolojileri yakından takip eden uzman kadromuzla, her yaştan misafirimize özel bir ilgi ve profesyonellik yaklaşıyoruz. Sadece bir cihaz satışı değil; doğru analiz, doğru uygulama ve kesintisiz destek süreciyle işitme sağlığınızın her adımında yanınızdayız.',

                // ── Hakkımızda — İstatistikler ───────────────────────────
                'about_stat_years'        => 1,
                'about_stat_patients'     => 10000,
                'about_stat_staff'        => 25,
                'about_stat_satisfaction' => 100,

                // ── Hakkımızda — Misyon & Vizyon & Değerler ─────────────
                'about_mission' => 'İşitme kaybı yaşayan her yaştan bireye, en güncel teknolojik donanımlarla ve tamamen kişiselleştirilmiş rehabilitasyon çözümleriyle ulaşarak; iletişim engellerini ortadan kaldırmak ve sosyal hayata tam katılımlarını sağlamak.',
                'about_vision'  => 'Yenilikçi yaklaşımımız ve etik değerlere bağlılığımızla; Karadeniz Bölgesi\'nin ve Türkiye\'nin en güvenilir işitme sağlığı markası olmak, bilimsel gelişmelere öncülük eden bir referans merkez haline gelmek.',
                'about_values'  => [
                    ['value' => 'Dürüstlük ve Şeffaflık'],
                    ['value' => 'Medikal Etik Kurallara Bağlılık'],
                    ['value' => 'Koşulsuz Hasta Memnuniyeti'],
                    ['value' => 'Sürekli Gelişim ve Yenilikçilik'],
                ],

                // ── Hakkımızda — Hizmet Alanları (artık sabit, seed için) ─
                'about_services' => null,
            ]
        );
    }
}
