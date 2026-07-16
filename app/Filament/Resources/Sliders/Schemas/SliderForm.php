<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Group::make()->schema([
                    Section::make('İçerik ve Metinler')
                        ->description('Slider üzerinde görünecek ana metinleri ayarlayın.')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            TextInput::make('title')
                                ->label('Ana Başlık')
                                ->required(),
                            
                            TextInput::make('subtitle')
                                ->label('Alt Başlık'),
                                
                            TextInput::make('button_text')
                                ->label('Buton Yazısı (Örn: Keşfet)'),
                                
                            TextInput::make('button_link')
                                ->label('Buton Yönlendirme Linki (URL)')
                                ->url(),
                        ]),
                ])->columnSpan(['sm' => 3, 'md' => 2]),

                Group::make()->schema([
                    Section::make('Görsel ve Ayarlar')
                        ->description('Arkaplan resmi ve gösterim ayarları.')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image_path')
                                ->label('Slider Görseli (1920x1080 önerilir)')
                                ->directory('sliders')
                                ->image()
                                ->imageEditor()
                                ->required(),
                                
                            TextInput::make('order')
                                ->label('Gösterim Sırası')
                                ->numeric()
                                ->default(0)
                                ->hint('Sıfır en önce gösterilir.'),
                                
                            Toggle::make('is_active')
                                ->label('Aktif (Sitede Gösterilsin mi?)')
                                ->default(true),
                        ]),
                ])->columnSpan(['sm' => 3, 'md' => 1]),
            ]);
    }
}
