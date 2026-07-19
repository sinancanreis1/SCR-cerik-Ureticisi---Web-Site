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
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Notifications\Notification;
use App\Models\SiteSetting;

class AboutPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $title = 'Hakkımda';
    protected static bool $shouldRegisterNavigation = true;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }
    protected static ?string $navigationLabel = 'Hakkımda';
    protected static ?int $navigationSort = 4;

    protected string $view = 'filament.pages.settings-page';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::first();
        if ($settings) {
            $this->form->fill($settings->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([

                Section::make('Hero (Banner) Alanı')
                    ->description('Hakkımızda sayfasının en üstündeki büyük arka plan görseli ve üzerindeki metinler.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('about_hero_image')
                            ->label('Banner Arka Plan Görseli')
                            ->disk('public')
                            ->directory('about')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                        TextInput::make('about_hero_subtitle')
                            ->label('Küçük Üst Başlık')
                            ->placeholder('Örn: Samsun Şehir İşitme Cihazları Merkezi'),
                        TextInput::make('about_hero_title')
                            ->label('Ana Başlık')
                            ->placeholder('Örn: Hakkımızda'),
                        Textarea::make('about_hero_desc')
                            ->label('Açıklama Metni')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Kurumsal Tanıtım Yazısı')
                    ->description('Hakkımızda sayfasının ortasındaki yazı ve yan görsel.')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextInput::make('about_intro_title')
                            ->label('Bölüm Başlığı')
                            ->placeholder('Örn: Hayatın Seslerine Yeniden Kavuşun')
                            ->columnSpanFull(),
                        Textarea::make('about_intro_text_1')
                            ->label('1. Paragraf Metni')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('about_intro_text_2')
                            ->label('2. Paragraf Metni')
                            ->rows(4)
                            ->columnSpanFull(),
                        FileUpload::make('about_intro_image')
                            ->label('Sağ Taraf Görseli')
                            ->disk('public')
                            ->directory('about')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Section::make('İstatistikler')
                    ->description('Sayfadaki dört sayacın (istatistik) değerlerini buradan ayarlayın.')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        TextInput::make('about_stat_years')
                            ->label('Yıllık Tecrübe')
                            ->numeric()
                            ->placeholder('Örn: 1'),
                        TextInput::make('about_stat_patients')
                            ->label('Mutlu Hasta Sayısı')
                            ->numeric()
                            ->placeholder('Örn: 10000'),
                        TextInput::make('about_stat_staff')
                            ->label('Uzman Personel Sayısı')
                            ->numeric()
                            ->placeholder('Örn: 25'),
                        TextInput::make('about_stat_satisfaction')
                            ->label('Hasta Memnuniyeti (%)')
                            ->numeric()
                            ->placeholder('Örn: 100'),
                    ])->columns(4),

                Section::make('Misyon, Vizyon & Değerler')
                    ->icon('heroicon-o-star')
                    ->schema([
                        Textarea::make('about_mission')
                            ->label('Misyonumuz')
                            ->rows(3),
                        Textarea::make('about_vision')
                            ->label('Vizyonumuz')
                            ->rows(3),
                        Repeater::make('about_values')
                            ->label('Değerlerimiz')
                            ->schema([
                                TextInput::make('value')
                                    ->label('Değer')
                                    ->required()
                                    ->placeholder('Örn: Dürüstlük ve Şeffaflık'),
                            ])
                            ->addActionLabel('Yeni Değer Ekle')
                            ->columnSpanFull(),
                    ])->columns(2),

            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Değişiklikleri Kaydet')
                ->submit('submit'),
        ];
    }

    public function submit(): void
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        $settings->fill($this->form->getState());
        $settings->save();

        Notification::make()
            ->title('Hakkımızda bilgileri güncellendi!')
            ->success()
            ->send();
    }
}
