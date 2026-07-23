<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Konten Landing Page';

    protected static ?string $modelLabel = 'Banner';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image_path')
                    ->label('Gambar Banner')
                    ->image()
                    ->directory('banners')
                    ->imageEditor()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->label('Judul')
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->label('Subjudul')
                    ->maxLength(255),
                TextInput::make('button_text')
                    ->label('Teks Tombol')
                    ->maxLength(255),
                TextInput::make('button_url')
                    ->label('Link Tombol')
                    ->url()
                    ->maxLength(255),
                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),
                Toggle::make('status')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order')
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Gambar'),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                IconColumn::make('status')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBanners::route('/'),
        ];
    }
}
