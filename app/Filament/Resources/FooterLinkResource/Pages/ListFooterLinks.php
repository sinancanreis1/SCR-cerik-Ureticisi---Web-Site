<?php

namespace App\Filament\Resources\FooterLinkResource\Pages;

use App\Filament\Resources\FooterLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

use Filament\Actions\Action;
use App\Models\SiteSetting;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

use Filament\Forms\Components\Select;
use App\Models\Category;

class ListFooterLinks extends ListRecords
{
    protected static string $resource = FooterLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit_column2_title')
                ->label('2. Sütun İçeriğini Seç')
                ->icon('heroicon-o-bars-3-bottom-right')
                ->color('gray')
                ->button()
                ->form([
                    Select::make('footer_column2_type')
                        ->label('Hangi Kategori Listelensin?')
                        ->options([
                            'services' => 'Hizmetlerimiz',
                            'products' => 'Ürünler',
                            'blogs'    => 'Blog',
                            'custom'   => 'Özel (Kendim Link Ekleyeceğim)',
                        ])
                        ->default(fn () => SiteSetting::first()?->footer_column2_type ?? 'services')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $setting = SiteSetting::first() ?? new SiteSetting();
                    $setting->footer_column2_type = $data['footer_column2_type'];
                    // Automatically update the title based on type
                    $titles = [
                        'services' => 'Hizmetlerimiz',
                        'products' => 'Ürünler',
                        'blogs'    => 'Blog',
                        'custom'   => 'Önemli Bağlantılar',
                    ];
                    $setting->footer_column2_title = $titles[$data['footer_column2_type']];
                    $setting->save();
                    Notification::make()->title('Kaydedildi')->success()->send();
                }),
            Action::make('edit_footer_about_text')
                ->label('Footer Yazısını Düzenle')
                ->icon('heroicon-o-document-text')
                ->color('gray')
                ->button()
                ->form([
                    Textarea::make('footer_about_text')
                        ->label('Metin')
                        ->rows(4)
                        ->default(fn () => SiteSetting::first()?->footer_about_text),
                ])
                ->action(function (array $data) {
                    $setting = SiteSetting::first() ?? new SiteSetting();
                    $setting->footer_about_text = $data['footer_about_text'];
                    $setting->save();
                    Notification::make()->title('Kaydedildi')->success()->send();
                }),
            CreateAction::make()
                ->label('Yeni Bağlantı Ekle')
                ->icon('heroicon-o-plus'),
        ];
    }
}
