<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use App\Models\SiteSetting;

class HomePage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Ana Sayfa Yönetimi';
    protected static ?string $navigationLabel = 'Ana Sayfa';
    protected static string|\UnitEnum|null $navigationGroup = 'Site İçeriği';
    protected static ?int $navigationSort = 0;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    protected string $view = 'filament.pages.home-page';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::first();

        $this->form->fill([
            'home_hero_subtitle' => $settings->home_hero_subtitle ?? 'Merhaba! Ben Sinan Can REİS.',
            'home_hero_title'    => $settings->home_hero_title ?? 'Yazılım, Yapay Zeka ve Dijital Dünyanın Şifreleri',
            'hero_description'   => $settings->hero_description ?? 'Sektörden güncel notlar, yazılım dünyasından ipuçları ve teknolojiye yön veren yenilikleri sizinle paylaşıyorum.',
            'home_selected_blog_categories' => $settings->home_selected_blog_categories ?? [],
            'home_selected_product_categories' => $settings->home_selected_product_categories ?? [],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Hero Alanı')
                    ->description('Ana sayfanın üst kısmındaki başlık ve açıklama metinlerini buradan düzenleyebilirsiniz.')
                    ->schema([
                        TextInput::make('home_hero_subtitle')
                            ->label('Giriş Metni (Küçük Başlık)')
                            ->placeholder('Merhaba! Ben Sinan Can REİS.')
                            ->helperText('Büyük başlığın üstünde görünen kısa tanıtım metni.')
                            ->required(),

                        TextInput::make('home_hero_title')
                            ->label('Ana Başlık')
                            ->placeholder('Yazılım, Yapay Zeka ve Dijital Dünyanın Şifreleri')
                            ->helperText('Sayfanın en büyük başlık metni.')
                            ->required(),

                        Textarea::make('hero_description')
                            ->label('Açıklama Metni')
                            ->placeholder('Sektörden güncel notlar, yazılım dünyasından ipuçları...')
                            ->helperText('Ana başlığın yanında görünen kısa açıklama metni.')
                            ->rows(3)
                            ->required(),
                    ]),
                    
                Section::make('Ana Sayfa Listelemeleri (Kategori Bazlı)')
                    ->description('Ana sayfada görünmesini istediğiniz kategorileri seçin. Seçtiğiniz kategorilerin en son içerikleri ana sayfada listelenir.')
                    ->schema([
                        \Filament\Forms\Components\Select::make('home_selected_sections')
                            ->label('Ana Sayfada Gösterilecek Bölümler')
                            ->multiple()
                            ->options([
                                'icerikler' => 'İçerikler',
                                'projelerim' => 'Projelerim',
                                'hakkimda' => 'Hakkımda'
                            ])
                            ->helperText('Ana sayfada görünmesini istediğiniz bölümleri seçin. Eğer hiçbirini seçmezseniz hepsi gösterilir.'),
                    ]),
            ]);
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }

        $settings->home_hero_subtitle = $data['home_hero_subtitle'];
        $settings->home_hero_title    = $data['home_hero_title'];
        $settings->hero_description   = $data['hero_description'];
        $settings->home_selected_blog_categories = $data['home_selected_sections'] ?? [];
        $settings->home_selected_product_categories = []; // We won't use this anymore but keep it for db compat
        $settings->save();

        Notification::make()
            ->title('Ana sayfa içerikleri başarıyla kaydedildi!')
            ->success()
            ->send();
    }
}
