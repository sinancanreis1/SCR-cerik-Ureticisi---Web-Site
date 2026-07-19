<?php

namespace App\Filament\Resources\DynamicItems;

use App\Filament\Resources\DynamicItems\DynamicItemResource\Pages;
use App\Models\DynamicItem;
use App\Models\HeaderLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DynamicItemResource extends Resource
{
    protected static \UnitEnum|string|null $navigationGroup = 'Site İçeriği';
    protected static ?string $model = DynamicItem::class;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $recordTitleAttribute = 'title';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-duplicate';
    
    public static function getModelLabel(): string
    {
        $headerLinkId = request()->query('header_link_id') 
            ?? request()->input('tableFilters.header_link_id.value')
            ?? (request()->route('record') ? DynamicItem::find(request()->route('record'))?->header_link_id : null);
            
        if ($headerLinkId && $headerLink = HeaderLink::find($headerLinkId)) {
            return $headerLink->label . ' İçeriği';
        }
        return 'Özel İçerik';
    }

    public static function getPluralModelLabel(): string
    {
        $headerLinkId = request()->query('header_link_id') 
            ?? request()->input('tableFilters.header_link_id.value')
            ?? (request()->route('record') ? DynamicItem::find(request()->route('record'))?->header_link_id : null);
            
        if ($headerLinkId && $headerLink = HeaderLink::find($headerLinkId)) {
            return $headerLink->label;
        }
        return 'Özel Sayfa İçerikleri';
    }

    public static function form(\Filament\Schemas\Schema $form): \Filament\Schemas\Schema
    {
        $headerLinkId = request()->query('header_link_id') 
            ?? request()->input('tableFilters.header_link_id.value')
            ?? (request()->route('record') ? DynamicItem::find(request()->route('record'))?->header_link_id : null);
            
        $headerLink = $headerLinkId ? HeaderLink::find($headerLinkId) : null;
        $template = $headerLink ? $headerLink->page_template : 'default';

        $schema = [];

        // Hangi sayfaya ekleneceğini gizli olarak tut
        if ($headerLinkId) {
            $schema[] = Forms\Components\Hidden::make('header_link_id')->default($headerLinkId);
        } else {
            $schema[] = Forms\Components\Select::make('header_link_id')
                ->label('Hangi Kategori / Sayfaya Eklenecek?')
                ->options(HeaderLink::where('is_dynamic_page', true)->pluck('label', 'id'))
                ->required()
                ->searchable()
                ->columnSpanFull();
        }

        // Split Layout: Sol (2/3) ve Sağ (1/3) kolonlar
        $leftColumn = [];
        $rightColumn = [];

        if ($template === 'products') {
            $leftColumn[] = \Filament\Schemas\Components\Section::make('Ürün Detayları')
                ->description('Sitede sergilenecek ürünün temel bilgileri.')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Ürün Adı')
                        ->required()
                        ->maxLength(255)
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        
                    Forms\Components\TextInput::make('slug')
                        ->label('URL Bağlantısı')
                        ->required()
                        ->unique(DynamicItem::class, 'slug', ignoreRecord: true)
                        ->maxLength(255),
                        
                    Forms\Components\Textarea::make('short_description')
                        ->label('Kısa Açıklama')
                        ->rows(3)
                        ->columnSpanFull(),
                        
                    Forms\Components\RichEditor::make('content')
                        ->label('Detaylı Açıklama')
                        ->columnSpanFull(),
                ])->columns(2);
                
            $rightColumn[] = \Filament\Schemas\Components\Section::make('Ürün Görseli')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Görsel')
                        ->image()
                        ->disk('public')
                        ->directory('dynamic_items'),
                ]);

            $rightColumn[] = \Filament\Schemas\Components\Section::make('Durum ve Sıralama')
                ->schema([
                    Forms\Components\TextInput::make('sort_order')
                        ->label('Sıra Numarası')
                        ->numeric()
                        ->default(0),
                        
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]);
                
        } elseif ($template === 'services') {
            $leftColumn[] = \Filament\Schemas\Components\Section::make('Hizmet Detayları')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Hizmet Adı')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->label('URL Bağlantısı')
                        ->required()
                        ->unique(DynamicItem::class, 'slug', ignoreRecord: true),
                    Forms\Components\RichEditor::make('content')
                        ->label('Hizmet Açıklaması')
                        ->columnSpanFull(),
                ])->columns(2);

            $rightColumn[] = \Filament\Schemas\Components\Section::make('Medya')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Hizmet Görseli')
                        ->image()
                        ->disk('public')
                        ->directory('dynamic_items'),
                ]);

            $rightColumn[] = \Filament\Schemas\Components\Section::make('Özellikler (İsteğe Bağlı)')
                ->schema([
                    Forms\Components\TextInput::make('features_title')
                        ->label('Özellikler Başlığı')
                        ->placeholder('Örn: Neden Bizi Seçmelisiniz?'),
                    Forms\Components\TagsInput::make('features')
                        ->label('Özellikler (Maddeler)')
                        ->placeholder('Madde ekleyin ve enter\'a basın'),
                    Forms\Components\Textarea::make('bottom_description')
                        ->label('Alt Açıklama')
                        ->rows(3),
                ]);

            $rightColumn[] = \Filament\Schemas\Components\Section::make('Ayarlar')
                ->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]);
        } else {
            // Blog or default
            $leftColumn[] = \Filament\Schemas\Components\Section::make('İçerik Bilgileri')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Başlık')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->label('URL Uzantısı')
                        ->required()
                        ->unique(DynamicItem::class, 'slug', ignoreRecord: true),
                    Forms\Components\Textarea::make('short_description')
                        ->label('Kısa Açıklama / Özet')
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('content')
                        ->label('Detaylı İçerik')
                        ->columnSpanFull(),
                ])->columns(2);

            $rightColumn[] = \Filament\Schemas\Components\Section::make('Medya')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Kapak Görseli')
                        ->image()
                        ->disk('public')
                        ->directory('dynamic_items'),
                ]);

            $rightColumn[] = \Filament\Schemas\Components\Section::make('Ayarlar')
                ->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]);
        }

        // Grid yapısı ile kolonları yan yana yerleştirme
        $schema[] = \Filament\Schemas\Components\Grid::make(3)
            ->schema([
                \Filament\Schemas\Components\Group::make()
                    ->schema($leftColumn)
                    ->columnSpan(2),
                \Filament\Schemas\Components\Group::make()
                    ->schema($rightColumn)
                    ->columnSpan(1),
            ])
            ->columnSpanFull();

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        $headerLinkId = request()->query('tableFilters')['header_link_id']['value'] ?? request()->query('header_link_id') ?? null;
        $headerLink = $headerLinkId ? HeaderLink::find($headerLinkId) : null;
        $template = $headerLink ? $headerLink->page_template : 'default';

        $table = $table->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) use ($headerLinkId) {
            if ($headerLinkId) {
                $query->where('header_link_id', $headerLinkId);
            }
        });

        if ($template === 'products' || $template === 'services') {
            return $table
                ->contentGrid([
                    'md' => 2,
                    'xl' => 3,
                ])
                ->columns([
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\ImageColumn::make('image')
                            ->disk('public')
                            ->height('200px')
                            ->width('100%')
                            ->extraImgAttributes(['style' => 'object-fit: cover; border-radius: 12px 12px 0 0;']),
                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\TextColumn::make('title')
                                ->weight('bold')
                                ->size('lg')
                                ->searchable()
                                ->sortable(),
                            Tables\Columns\ToggleColumn::make('is_active')
                                ->label('Durum'),
                        ])->space(1)->extraAttributes(['style' => 'padding: 16px;']),
                    ])->space(0)
                ])
                ->filters([
                    Tables\Filters\SelectFilter::make('header_link_id')
                        ->label('Kategori')
                        ->options(HeaderLink::where('is_dynamic_page', true)->pluck('label', 'id'))
                        ->hidden(fn () => $headerLinkId !== null),
                ])
                ->actions([
                    \Filament\Actions\EditAction::make()->button(),
                    \Filament\Actions\DeleteAction::make()->button(),
                ])
                ->bulkActions([
                    \Filament\Actions\BulkActionGroup::make([
                        \Filament\Actions\DeleteBulkAction::make(),
                    ]),
                ])
                ->defaultSort('sort_order', 'asc');
        }

        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Görsel')
                    ->disk('public')
                    ->defaultImageUrl(url('images/logo.png'))
                    ->circular(),
                Tables\Columns\TextColumn::make('title')->label('Başlık')->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->date('d.m.Y')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Durum'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('header_link_id')
                    ->label('Kategori / Sayfa Filtresi')
                    ->options(HeaderLink::where('is_dynamic_page', true)->pluck('label', 'id'))
                    ->hidden(fn () => $headerLinkId !== null),
            ])
            ->actions([
                \Filament\Actions\EditAction::make()->iconButton()->extraAttributes(['style' => 'margin-right: 15px; margin-bottom: 5px;']),
                \Filament\Actions\DeleteAction::make()->iconButton()->extraAttributes(['style' => 'margin-bottom: 5px;']),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\DynamicItems\Pages\ListDynamicItems::route('/'),
            'create' => \App\Filament\Resources\DynamicItems\Pages\CreateDynamicItem::route('/create'),
            'edit' => \App\Filament\Resources\DynamicItems\Pages\EditDynamicItem::route('/{record}/edit'),
        ];
    }
}
