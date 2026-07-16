<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Grid;

class ChildrenRelationManager extends RelationManager
{
    protected static string $relationship = 'children';
    protected static ?string $title = 'Alt Kategoriler (Hizmet İçerikleri)';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Kategori Adı')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    Forms\Components\TextInput::make('slug')
                        ->label('Sayfa Linki (URL)')
                        ->required()
                        ->unique(table: 'categories', ignoreRecord: true)
                        ->prefix('site.com/hizmetler/')
                        ->hint('Otomatik oluşur, çakışma durumunda elle değiştirebilirsiniz.'),
                        
                    Forms\Components\RichEditor::make('description')
                        ->label('Hizmet İçeriği (Detaylı)')
                        ->required()
                        ->columnSpanFull(),

                    \Filament\Schemas\Components\Section::make('Neden Biz? & Ekstra Tasarım Alanları')
                        ->schema([
                            Forms\Components\TextInput::make('features_title')
                                ->label('Özellikler Başlığı (Örn: Neden Biz?)'),
                            Forms\Components\Repeater::make('features')
                                ->label('Özellik Listesi')
                                ->simple(
                                    Forms\Components\TextInput::make('feature')->required(),
                                )
                                ->addActionLabel('Yeni Özellik Ekle'),
                            Forms\Components\Textarea::make('bottom_description')
                                ->label('Alt Açıklama Metni')
                                ->rows(3),
                        ]),

                    Forms\Components\FileUpload::make('image')
                        ->label('Kategori Görseli')
                        ->disk('public')
                        ->directory('categories')
                        ->image()
                        ->imageEditor()
                        ->panelLayout('integrated')
                        ->columnSpanFull(),
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Görsel')->circular()->disk('public'),
                Tables\Columns\TextColumn::make('name')->label('Kategori Adı')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('URL'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make()->label('Yeni Alt Kategori Ekle'),
            ])
            ->actions([
                \Filament\Actions\EditAction::make()->iconButton()->extraAttributes(['style' => 'margin-right: 12px;']),
                \Filament\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
