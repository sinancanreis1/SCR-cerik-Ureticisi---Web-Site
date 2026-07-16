<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterLinkResource\Pages;
use App\Models\FooterLink;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FooterLinkResource extends Resource
{
    protected static ?string $model = FooterLink::class;
    protected static ?string $recordTitleAttribute = 'label';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationLabel = 'Footer(Alt Alan)';
    protected static ?string $modelLabel = 'Footer Bağlantısı';
    protected static ?string $pluralModelLabel = 'Footer(Alt Alan)';
    protected static \UnitEnum|string|null $navigationGroup = 'Site İçeriği';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Select::make('column')
                    ->label('Sütun')
                    ->options([
                        'quick_links' => 'Hızlı Bağlantılar',
                        'services' => '2. Sütun (İsim Değişebilir)',
                    ])
                    ->required()
                    ->default('quick_links')
                    ->columnSpanFull(),

                Select::make('predefined_link')
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
                                $catOptions['/hizmetlerimiz/' . $cat->slug] = $cat->name;
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
                            $allOptions['/hizmetlerimiz/' . $cat->slug] = $cat->name;
                        }
                        if (isset($allOptions[$state])) {
                            $set('label', $allOptions[$state]);
                            $set('url', $state);
                            if (str_starts_with($state, '/hizmetlerimiz/') && $state !== '/hizmetlerimiz') {
                                $set('column', 'services');
                            } else {
                                $set('column', 'quick_links');
                            }
                        }
                    })
                    ->columnSpanFull()
                    ->helperText('Sitede var olan bir sayfayı veya hizmeti seçerseniz, aşağıdaki Sütun, Menü Yazısı ve URL alanları otomatik dolar. İsterseniz sonrasında düzenleyebilirsiniz.'),

                TextInput::make('label')
                    ->label('Menü Yazısı')
                    ->required()
                    ->placeholder('Örnek: Ana Sayfa, Projeler'),

                TextInput::make('url')
                    ->label('URL (Bağlantı Adresi)')
                    ->required()
                    ->placeholder('/hakkimizda'),

                TextInput::make('sort_order')
                    ->label('Sıra')
                    ->numeric()
                    ->default(0),

                TextInput::make('icon')
                    ->label('İkon (İsteğe Bağlı)')
                    ->placeholder('Örn: ri-home-line')
                    ->helperText('Remix Icon sınıflarını kullanabilirsiniz. Boş bırakılabilir.'),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->inline(false),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('Sıra')
                    ->sortable()
                    ->width('60px'),

                TextColumn::make('label')
                    ->label('Menü Yazısı')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('url')
                    ->label('URL')
                    ->searchable(),

                TextColumn::make('column')
                    ->label('Sütun')
                    ->formatStateUsing(fn($state) => match($state) {
                        'quick_links' => 'Hızlı Bağlantılar',
                        'services'    => 'Hizmetlerimiz',
                        default       => $state,
                    })
                    ->badge()
                    ->color(fn($state) => match($state) {
                        'quick_links' => 'info',
                        'services'    => 'success',
                        default       => 'gray',
                    }),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('column')
                    ->label('Sütun')
                    ->options([
                        'quick_links' => 'Hızlı Bağlantılar',
                        'services' => 'Hizmetlerimiz',
                    ]),
            ])
            ->actions([
                EditAction::make()
                    ->iconButton()
                    ->extraAttributes([
                        'style' => 'margin-right: 12px; background-color: #00bcd4; color: white; border-radius: 4px; padding: 4px;'
                    ]),
                DeleteAction::make()
                    ->iconButton()
                    ->extraAttributes([
                        'style' => 'background-color: #f44336; color: white; border-radius: 4px; padding: 4px;'
                    ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListFooterLinks::route('/'),
            'create' => Pages\CreateFooterLink::route('/create'),
            'edit'   => Pages\EditFooterLink::route('/{record}/edit'),
        ];
    }
}
