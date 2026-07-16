<?php

namespace App\Filament\Resources\HeaderLinks;

use App\Models\HeaderLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\IconColumn;

class HeaderLinkResource extends Resource
{
    protected static ?string $model = \App\Models\HeaderLink::class;
    protected static ?string $recordTitleAttribute = 'label';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-bars-3';
    protected static \UnitEnum|string|null $navigationGroup = 'Site İçeriği';
    protected static ?string $navigationLabel = 'Header(Üst Çubuk)';
    protected static ?string $modelLabel = 'Üst Menü Bağlantısı';
    protected static ?string $pluralModelLabel = 'Üst Menü Bağlantıları';
    protected static ?int $navigationSort = 4;

    public static function form(\Filament\Schemas\Schema $form): \Filament\Schemas\Schema
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Select::make('predefined_link')
                    ->label('Hazır Bağlantı Seç (Otomatik Doldurur)')
                    ->options(function () {
                        $options = [
                            'Sabit Sayfalar' => [
                                '/' => 'Ana Sayfa',
                                '/kurumsal/hakkimizda' => 'Hakkımızda',
                                '/hizmetlerimiz' => 'Hizmetlerimiz',
                                '/blog' => 'Blog',
                                '/iletisim' => 'İletişim',
                            ],
                        ];
                        
                        $categories = \App\Models\Category::all();
                        if ($categories->count() > 0) {
                            $catOptions = [];
                            foreach ($categories as $cat) {
                                $catOptions['/hizmetler/' . $cat->slug] = $cat->name;
                            }
                            $options['Hizmetler'] = $catOptions;
                        }
                        
                        return $options;
                    })
                    ->searchable()
                    ->dehydrated(false)
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        if (!$state) return;
                        $allOptions = [
                            '/' => 'Ana Sayfa',
                            '/kurumsal/hakkimizda' => 'Hakkımızda',
                            '/hizmetlerimiz' => 'Hizmetlerimiz',
                            '/blog' => 'Blog',
                            '/iletisim' => 'İletişim',
                        ];
                        foreach (\App\Models\Category::all() as $cat) {
                            $allOptions['/hizmetler/' . $cat->slug] = $cat->name;
                        }
                        if (isset($allOptions[$state])) {
                            $set('label', $allOptions[$state]);
                            $set('url', $state);
                        }
                    })
                    ->columnSpanFull()
                    ->helperText('Sitede var olan bir sayfayı veya hizmeti seçerseniz, aşağıdaki Menü Yazısı ve URL alanları otomatik dolar.'),

                TextInput::make('label')
                    ->label('Menü Yazısı')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->label('Bağlantı URL')
                    ->required()
                    ->maxLength(255),
                TextInput::make('icon')
                    ->label('İkon (İsteğe Bağlı)')
                    ->placeholder('Örn: ri-home-line')
                    ->helperText('Remix Icon sınıflarını kullanabilirsiniz. Boş bırakılabilir.')
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->label('Sıralama')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
                
                \Filament\Schemas\Components\Section::make('Özel Sayfa / Kategori Ayarları')
                    ->description('Bu menü bağlantısı için özel içerikler ekleyebileceğiniz dinamik bir sayfa oluşturabilirsiniz.')
                    ->schema([
                        Toggle::make('is_dynamic_page')
                            ->label('Bu bağlantı için Dinamik Özel Sayfa oluşturulsun mu?')
                            ->helperText('Aktif ederseniz, yönetim panelinde bu kategoriye ait özel içerikler ekleyebileceğiniz bir kart açılır.')
                            ->reactive(),
                        \Filament\Forms\Components\Hidden::make('page_template')
                            ->default('blog'),
                        TextInput::make('page_title')
                            ->label('Sayfa Başlığı')
                            ->visible(fn ($get) => $get('is_dynamic_page'))
                            ->helperText('Örn: Ürünlerimiz. Boş bırakılırsa Menü Yazısı kullanılır.')
                            ->maxLength(255),
                        \Filament\Forms\Components\Textarea::make('page_description')
                            ->label('Kategori Açıklaması')
                            ->visible(fn ($get) => $get('is_dynamic_page'))
                            ->helperText('Sayfanın üst kısmında görünecek açıklama metni.'),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('icon')->label('İkon'),
                TextColumn::make('label')->label('Menü Yazısı')->searchable(),
                TextColumn::make('url')->label('URL'),
                ToggleColumn::make('is_active')->label('Durum'),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->filters([])
            ->actions([
                \Filament\Actions\EditAction::make()
                    ->iconButton()
                    ->extraAttributes([
                        'style' => 'margin-right: 12px; background-color: #00bcd4; color: white; border-radius: 4px; padding: 4px;'
                    ]),
                \Filament\Actions\DeleteAction::make()
                    ->iconButton()
                    ->extraAttributes([
                        'style' => 'background-color: #f44336; color: white; border-radius: 4px; padding: 4px;'
                    ]),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\HeaderLinks\Pages\ManageHeaderLinks::route('/'),
        ];
    }
}
