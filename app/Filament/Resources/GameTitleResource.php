<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameTitleResource\Pages;
use App\Filament\Resources\GameTitleResource\RelationManagers;
use App\Models\GameTitle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameTitleResource extends Resource
{
    protected static ?string $model = GameTitle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form->schema([
       TextInput::make('title')
    ->required()
    ->live(onBlur: true)
    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
    ->label('Nama Event'),

TextInput::make('slug')
    ->required()
    ->readOnly()
    ->label('Slug (URL)'),
        TextInput::make('developer')->label('Pengembang (Developer)'),
        FileUpload::make('cover_image')->image()->directory('games')->label('Gambar Cover'),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListGameTitles::route('/'),
            'create' => Pages\CreateGameTitle::route('/create'),
            'edit' => Pages\EditGameTitle::route('/{record}/edit'),
        ];
    }
}
