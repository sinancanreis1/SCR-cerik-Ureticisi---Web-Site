<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use App\Models\SiteSetting;
use App\Models\HeaderLink;

class HomePage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Ana Sayfa İçerik Yönetimi';
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    protected string $view = 'filament.pages.settings-page';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::first();
        
        $defaults = [
            'home_about_title' => "Samsun Şehir İşitme Cihazları Merkezi olarak 15 yılı aşkın tecrübeyle Samsun'da hizmet veriyoruz.",
            'home_about_text' => "İşitme sağlığı, bireylerin yaşam kalitesini ve sosyal bağlarını belirleyen en önemli faktörlerden biridir. Samsun'un en güvenilir işitme sağlığı merkezi olarak, sevdiklerinizin sesinden ve hayatın doğal ritminden kopmamanız için uluslararası standartlarda, kişiye özel ve en ileri teknoloji işitme çözümlerini sunuyoruz. Uzman odyologlarımız, modern altyapımız ve her zaman güler yüzlü ekibimizle sağlığınız için yanınızdayız.",
            'home_mission_title' => 'Misyonumuz',
            'home_mission_text' => 'İşitme kaybı yaşayan her yaştan bireye, en güncel teknolojik donanımlarla ve tamamen kişiselleştirilmiş rehabilitasyon çözümleriyle ulaşarak; iletişim engellerini ortadan kaldırmak, sosyal hayata tam ve özgüvenli katılımlarını sağlamak ve yaşam kalitelerini sürdürülebilir şekilde en üst düzeye çıkarmaktır.',
            'home_vision_title' => 'Vizyonumuz',
            'home_vision_text' => 'Yenilikçi yaklaşımımız, etik değerlere bağlılığımız ve üstün hasta memnuniyeti anlayışımızla; Karadeniz Bölgesi\'nin ve Türkiye\'nin en güvenilir işitme sağlığı markası olmak, sektördeki bilimsel ve teknolojik gelişmelere öncülük eden bir referans merkez olarak nesiller boyu anılmaktır.',
            'home_quiz_questions' => [
                ['q' => "Kalabalık ortamlarda konuşmaları anlamakta zorlanıyor musunuz?"],
                ['q' => "Televizyonun sesini başkalarına rahatsızlık verecek kadar açıyor musunuz?"],
                ['q' => "İnsanların sürekli mırıldandığını veya sessiz konuştuğunu düşünüyor musunuz?"],
                ['q' => "Konuşulanları sık sık tekrar ettirme ihtiyacı duyuyor musunuz?"],
                ['q' => "Telefon görüşmelerinde karşı tarafın sesini duymakta güçlük çekiyor musunuz?"]
            ],
            'home_features_title' => "Neden Samsun Şehir İşitme Cihazları Merkezi?",
            'home_features_subtitle' => "Avantajlarımız",
            'home_features' => [
                ['title' => 'Uzman Klinik Kadro', 'desc' => 'Üniversitelerin odyoloji bölümlerinden mezun, sürekli eğitime tabi tutulan deneyimli uzman odyolog ve teknik destek ekibi ile profesyonel hizmet sunuyoruz.', 'icon' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
                ['title' => 'Üstün Kalite, Uygun Fiyat', 'desc' => 'Dünyanın en iyi işitme cihazı markalarını, her bütçeye uygun ödeme kolaylıkları ve geniş model seçenekleriyle erişilebilir kılıyoruz.', 'icon' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>'],
                ['title' => 'Tam SGK Anlaşması', 'desc' => 'Devlet desteğinden maksimum düzeyde faydalanabilmeniz için rapor takibi, evrak düzenleme ve tüm SGK prosedürlerinizi sizin adınıza titizlikle yönetiyoruz.', 'icon' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
                ['title' => '7/24 Kesintisiz Destek', 'desc' => 'Satış sonrası hizmetler kapsamında; adaptasyon süreci, ince ayar güncellemeleri ve teknik danışmanlık konularında her zaman yanınızda olmaya devam ediyoruz.', 'icon' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 3.07 5.18 2 2 0 0 1 5.08 3h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>'],
                ['title' => 'Hızlı Acil Servis', 'desc' => 'Olası arıza durumlarında mağduriyet yaşamamanız için kendi laboratuvarımızda hızlı cihaz tamiri, kulak kalıbı üretimi ve yedek cihaz desteği sağlıyoruz.', 'icon' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M10 14h4"/><path d="M12 12v4"/></svg>'],
                ['title' => 'Online Odyolojik Danışma', 'desc' => 'Kliniğimize gelemediğiniz durumlarda, uzaktan bağlantı ile işitme cihazı ayarlarınızı güncelliyor ve görüntülü online danışmanlık hizmeti veriyoruz.', 'icon' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>']
            ],
            'home_section4_type' => 'products',
            'home_section4_title' => 'Öne Çıkan İşitme Cihazları',
            'home_section4_subtitle' => 'Ürünlerimiz',
            'home_steps_title' => 'Hayatın Ritminden Kopmayın, Seslere Yeniden Hayat Veriyoruz.',
            'home_steps_description' => 'İşitme kaybı sadece sesleri duymanızı değil, sevdiklerinizle olan güçlü bağlarınızı ve sosyal hayatınızı da doğrudan etkiler. Samsun Şehir İşitme Merkezi olarak, en modern teşhis yöntemlerimiz ve kişiye özel yüksek teknoloji işitme çözümlerimizle sizi hayata çok daha özgüvenli bir şekilde geri bağlıyoruz.',
            'home_steps' => [
                ['title' => "Ücretsiz İşitme Testi", 'desc' => "Kliniğimizde uzman odyologlarımız eşliğinde kapsamlı ve ücretsiz işitme testinizi hemen yaptırın.", 'link' => "/iletisim", 'img' => "/images/fitting.png"],
                ['title' => "Kişiye Özel Cihaz", 'desc' => "Yaşam tarzınıza, bütçenize ve işitme kaybı derecenize en uygun yeni nesil cihazı birlikte seçelim.", 'link' => "/hizmetlerimiz", 'img' => "/images/hero_devices.png"],
                ['title' => "Gerçek Hayatta Deneme", 'desc' => "Seçtiğiniz işitme cihazını günlük hayatın içinde, kendi sosyal ortamınızda deneyimleyerek karar verin.", 'link' => "/hakkimizda", 'img' => "/images/hero_hearing_aid.png"],
                ['title' => "Uzman Adaptasyon", 'desc' => "Cihazınızın akustik programlamasını ince detaylarla yapıyoruz. Alışma sürecinizde daima yanınızdayız.", 'link' => "/iletisim", 'img' => "/images/team_photo.png"],
                ['title' => "Ömür Boyu Destek", 'desc' => "Periyodik bakımlar, pil desteği ve teknik servis ile yıllar boyu kesintisiz duymanızı sağlıyoruz.", 'link' => "/hakkimizda", 'img' => "/images/clinic_building.png"]
            ],
            'home_stats' => [
                ['end' => 100, 'suffix' => '%', 'label' => 'Müşteri Memnuniyeti'],
                ['end' => 15, 'suffix' => '+', 'label' => 'Yıllık Deneyim'],
                ['end' => 5000, 'suffix' => '+', 'label' => 'Mutlu Hasta'],
                ['end' => 24, 'suffix' => '/7', 'label' => 'Destek Hizmeti']
            ],
            'home_section7_type' => 'categories',
            'home_section7_title' => 'Hizmetlerimiz ve Çözümlerimiz',
            'home_section7_subtitle' => 'Çözümlerimiz',
            'home_testimonials_title' => 'Hastalarımız Bizi Anlatıyor',
            'home_testimonials_subtitle' => 'Referanslar',
            'home_testimonials_widget_id' => 'd08eeaad-4f80-42f5-97d4-b6808bb8438a',
            'home_faq_title' => 'Sık Sorulan Sorular',
            'home_faq_description' => 'İşitme sağlığı ve işitme cihazları hakkında merak ettiğiniz soruların cevaplarını burada bulabilirsiniz. Daha fazla bilgi için bize ulaşın.',
            'home_faqs' => [
                ['question' => 'İşitme testi ücretsiz mi?', 'answer' => 'Evet, Samsun Şehir İşitme Cihazları Merkezi\'mizde gerçekleştirilen odyolojik işitme testleri tamamen ücretsizdir. Uzman odyologlarımız tarafından son teknoloji cihazlarla yapılan detaylı işitme değerlendirmesi yaklaşık 30 dakika sürmektedir. Randevu alarak hemen ücretsiz testinizi yaptırabilirsiniz.'],
                ['question' => 'İşitme cihazı SGK tarafından karşılanıyor mu?', 'answer' => 'Evet, SGK anlaşmalı bir merkez olarak, devlet hastaneleri veya tam teşekküllü özel hastanelerden alacağınız uzman doktor raporu ile birlikte işitme cihazı bedelinin önemli bir kısmı SGK tarafından karşılanmaktadır. SGK işlemlerinizin tüm süreçlerinde hasta danışmanlarımız size rehberlik etmektedir.'],
                ['question' => 'İşitme cihazı kullanmaya ne zaman başlamalıyım?', 'answer' => 'İşitme kaybı fark edildiği veya şüphelenildiği anda vakit kaybetmeden bir uzmana başvurulmalıdır. Erken teşhis ve cihazlandırma, beynin sesleri algılama yeteneğini korumasında kritik rol oynar. İşitme kaybı tedavi edilmediğinde, zamanla konuşmayı anlama eşiğinde kalıcı gerilemelere ve sosyal izolasyona yol açabilir.'],
                ['question' => 'İşitme cihazının bakımı nasıl yapılır?', 'answer' => 'Cihazınızın uzun ömürlü olması için düzenli bakım şarttır. Günlük temizlik rutinlerinin yanı sıra nem alıcı kutuların kullanılması elektronik aksamı korur. Merkezimizde detaylı cihaz temizliği, ince ayar, filtre ve hortum değişimi gibi periyodik bakım hizmetlerini profesyonel olarak sunmaktayız. 6 ayda bir uzman kontrolü tavsiye ediyoruz.'],
                ['question' => 'Deneme süresi var mı?', 'answer' => 'Kesinlikle. İşitme cihazının yaşam tarzınıza ve işitme profilinize uygunluğunu görebilmeniz için satın almadan önce deneme süresi sunuyoruz. Bu süreçte cihazı evinizde, iş yerinizde ve sosyal ortamlarınızda kullanarak performansını bizzat test edebilirsiniz. Hedefimiz %100 hasta memnuniyetidir.']
            ]
        ];

        if ($settings) {
            $data = $settings->toArray();
            
            // Eğer JSON alanları boşsa veya null ise, default değerlerle doldur.
            foreach ($defaults as $key => $val) {
                if (empty($data[$key])) {
                    $data[$key] = $val;
                }
            }
            
            $this->form->fill($data);
        } else {
            $this->form->fill($defaults);
        }
    }

    protected function getDynamicPageOptions(): array
    {
        $options = [
            'products' => 'Ürünler',
            'blogs' => 'Blog Yazıları',
            'categories' => 'Hizmetlerimiz (Kategoriler)',
        ];

        if (\Illuminate\Support\Facades\Schema::hasTable('header_links')) {
            $dynamicPages = HeaderLink::where('is_dynamic_page', true)->where('is_active', true)->get();
            foreach ($dynamicPages as $page) {
                $options['dynamic_' . $page->id] = 'Dinamik Sayfa: ' . $page->label;
            }
        }

        return $options;
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([

                Section::make('Hakkımızda Özeti')
                    ->icon('heroicon-o-information-circle')
                    ->collapsible()
                    ->schema([
                        TextInput::make('home_about_title')->label('Başlık'),
                        Textarea::make('home_about_text')->label('Açıklama')->rows(10),
                        TextInput::make('home_mission_title')->label('Misyon Başlığı')->default('Misyonumuz'),
                        Textarea::make('home_mission_text')->label('Misyon Açıklaması')->rows(4),
                        TextInput::make('home_vision_title')->label('Vizyon Başlığı')->default('Vizyonumuz'),
                        Textarea::make('home_vision_text')->label('Vizyon Açıklaması')->rows(4),
                    ]),
                    
                Section::make('Avantajlarımız (Neden Bizi Tercih Etmelisiniz?)')
                    ->icon('heroicon-o-star')
                    ->collapsible()
                    ->schema([
                        TextInput::make('home_features_title')->label('Ana Başlık'),
                        TextInput::make('home_features_subtitle')->label('Alt Başlık'),
                        Repeater::make('home_features')
                            ->label('Avantaj Kartları')
                            ->schema([
                                TextInput::make('title')->label('Kart Başlığı')->required(),
                                Textarea::make('desc')->label('Açıklama')->required()->rows(3),
                                Textarea::make('icon')->label('İkon (SVG Kodu)')->required()->rows(3),
                            ])
                            ->defaultItems(6)
                            ->reorderableWithButtons()
                    ]),
                    
                Section::make('Bölüm 4 (Ürünlerimiz Alanı)')
                    ->description('Şu anki "Ürünlerimiz" alanında hangi içeriklerin listeleneceğini seçin.')
                    ->icon('heroicon-o-squares-2x2')
                    ->collapsible()
                    ->schema([
                        Select::make('home_section4_type')
                            ->label('Veri Kaynağı')
                            ->options($this->getDynamicPageOptions())
                            ->required(),
                        TextInput::make('home_section4_title')->label('Başlık'),
                        TextInput::make('home_section4_subtitle')->label('Alt Başlık'),
                    ]),
                    
                Section::make('Adımlar (Nasıl Yardımcı Oluyoruz?)')
                    ->icon('heroicon-o-map')
                    ->collapsible()
                    ->schema([
                        TextInput::make('home_steps_title')->label('Üst Başlık'),
                        Textarea::make('home_steps_description')->label('Açıklama')->rows(3),
                        Repeater::make('home_steps')
                            ->label('Adım Kartları')
                            ->schema([
                                TextInput::make('title')->label('Adım Başlığı')->required(),
                                Textarea::make('desc')->label('Açıklama')->required()->rows(2),
                                TextInput::make('link')->label('Yönlendirme Linki (Örn: /iletisim)'),
                                FileUpload::make('img')->label('Görsel (Eğer özel görsel eklerseniz orijinal görselin yerini alır)')->directory('homepage')->disk('public')->image(),
                            ])
                            ->defaultItems(5)
                            ->reorderableWithButtons()
                    ]),
                    
                Section::make('İstatistikler (Sayılarla Biz)')
                    ->icon('heroicon-o-chart-bar')
                    ->collapsible()
                    ->schema([
                        Repeater::make('home_stats')
                            ->label('Sayaçlar')
                            ->schema([
                                TextInput::make('end')->label('Sayı')->numeric()->required(),
                                TextInput::make('suffix')->label('Ek / Yüzde (Örn: %, +)'),
                                TextInput::make('label')->label('Etiket (Örn: Mutlu Hasta)')->required(),
                            ])
                            ->defaultItems(4)
                            ->reorderableWithButtons()
                    ]),
                    
                Section::make('Bölüm 7 (Çözümlerimiz Alanı)')
                    ->description('Şu anki "Çözümlerimiz" alanında hangi içeriklerin listeleneceğini seçin.')
                    ->icon('heroicon-o-rectangle-group')
                    ->collapsible()
                    ->schema([
                        Select::make('home_section7_type')
                            ->label('Veri Kaynağı')
                            ->options($this->getDynamicPageOptions())
                            ->required(),
                        TextInput::make('home_section7_title')->label('Başlık'),
                        TextInput::make('home_section7_subtitle')->label('Alt Başlık'),
                    ]),
                    
                Section::make('Referanslar (Müşteri Yorumları)')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->collapsible()
                    ->schema([
                        TextInput::make('home_testimonials_title')->label('Başlık'),
                        TextInput::make('home_testimonials_subtitle')->label('Alt Başlık'),
                        TextInput::make('home_testimonials_widget_id')
                            ->label('Elfsight Widget ID')
                            ->helperText('Sadece id değerini girin (Örn: d08eeaad-4f80-42f5-97d4-b6808bb8438a)'),
                    ]),
                    
                Section::make('Sıkça Sorulan Sorular')
                    ->icon('heroicon-o-document-text')
                    ->collapsible()
                    ->schema([
                        TextInput::make('home_faq_title')->label('Başlık'),
                        Textarea::make('home_faq_description')->label('Açıklama')->rows(2),
                        Repeater::make('home_faqs')
                            ->label('Soru & Cevap Listesi')
                            ->schema([
                                TextInput::make('question')->label('Soru')->required(),
                                Textarea::make('answer')->label('Cevap')->required()->rows(3),
                            ])
                            ->defaultItems(5)
                            ->reorderableWithButtons()
                    ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }

        $settings->fill($data);
        $settings->save();

        Notification::make()
            ->title('Başarılı')
            ->body('Ana sayfa içerikleri başarıyla güncellendi.')
            ->success()
            ->send();
    }
}
