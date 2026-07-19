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

class SettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $title = 'Genel Ayarlar';
    protected static bool $shouldRegisterNavigation = false;
    protected static \UnitEnum|string|null $navigationGroup = 'Site İçeriği';

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

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
                Section::make('İletişim Bilgileri')
                    ->description('Müşterilerin size ulaşabileceği iletişim kanalları.')
                    ->icon('heroicon-o-phone')
                    ->schema([
                    TextInput::make('phone')->label('Telefon'),
                    TextInput::make('whatsapp_number')->label('WhatsApp Numarası'),
                    TextInput::make('email')->label('E-Posta'),
                    Textarea::make('address')->label('Adres')->columnSpanFull(),
                    Textarea::make('map_url')->label('Harita URL (Iframe vb.)')->columnSpanFull(),
                    Textarea::make('working_hours')
                        ->label('Çalışma Saatleri')
                        ->columnSpanFull()
                        ->placeholder("Örnek:\nHafta İçi: 09:00 - 18:00\nCumartesi: 09:00 - 18:00\nPazar: Kapalı"),
                ])->columns(2),
                
                Section::make('Sosyal Medya')
                    ->description('Resmi sosyal medya hesaplarınızın bağlantıları.')
                    ->icon('heroicon-o-share')
                    ->schema([
                    TextInput::make('facebook_url')->label('Facebook'),
                    TextInput::make('instagram_url')->label('Instagram'),
                    TextInput::make('twitter_url')->label('Twitter/X'),
                    TextInput::make('linkedin_url')->label('LinkedIn'),
                ])->columns(2),
                


            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Kaydet')
                ->submit('submit'),
        ];
    }

    public function submit(): void
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        $settings->fill($this->form->getState());
        $settings->save();

        Notification::make()
            ->title('Ayarlar başarıyla kaydedildi')
            ->success()
            ->send();
    }
}
