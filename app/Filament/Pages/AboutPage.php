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
    protected static \UnitEnum|string|null $navigationGroup = 'Site İçeriği';
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $title = 'Hakkımızda';
    protected static bool $shouldRegisterNavigation = true;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }
    protected static ?string $navigationLabel = 'Hakkımızda';
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

                Section::make('Sayfa Üst Başlığı (Breadcrumb)')
                    ->description('Hakkımda sayfasının en üstündeki iki parçalı başlık.')
                    ->icon('heroicon-o-bars-3-bottom-left')
                    ->schema([
                        TextInput::make('about_hero_title')
                            ->label('1. Satır')
                            ->placeholder('Benim'),
                        TextInput::make('about_hero_subtitle')
                            ->label('2. Satır')
                            ->placeholder('hikayem'),
                    ])->columns(2),

                Section::make('Hakkımda Görseli')
                    ->description('Hakkımda sayfasındaki sol taraftaki fotoğraf.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('about_intro_image')
                            ->label('Görsel')
                            ->disk('public')
                            ->directory('about')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Section::make('Hakkımda Yazısı')
                    ->description('Başlık, biyografi metni ve yetkinlikler alanı.')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('about_intro_title')
                            ->label('Bölüm Başlığı')
                            ->placeholder('Yazılım ve Dijital Gelişim Serüvenim')
                            ->columnSpanFull(),
                        Textarea::make('about_intro_text_1')
                            ->label('Biyografi Metni')
                            ->helperText('Ana hikaye paragrafınız. Uzun metin yazabilirsiniz.')
                            ->rows(10)
                            ->columnSpanFull(),
                        Textarea::make('about_intro_text_2')
                            ->label('Teknik Yetkinlikler ve Vizyon')
                            ->helperText('🔹 ile başlayan yetkinlikleriniz ve nihai amacınız.')
                            ->rows(8)
                            ->columnSpanFull(),
                    ]),
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
