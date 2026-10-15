<?php

namespace App\Filament\Resources;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
           ->schema([
           TextInput::make('title')
                 ->label('Judul Game')
                 ->required()
                 ->maxLength(255)
                 ->live(onBlur: true)
                 ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

             TextInput::make('slug')
                 ->label('Slug (URL)')
                 ->required()
                 ->maxLength(255)
                 ->unique(ignoreRecord: true),

            Select::make('platforms')
                ->label('Platform')
                ->relationship('platforms', 'name')
                ->multiple()
                ->preload(),

                Select::make('genres')
                ->label('Genre')
                ->relationship('genres', 'name')
                ->multiple()
                ->preload(),

            FileUpload::make('cover_image')
                ->label('Gambar Sampul (Cover)')
                ->image()
                ->directory('game-covers')
                ->columnSpanFull(),

            Textarea::make('description')
                ->label('Deskripsi Singkat')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
           ->columns([
                ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->square(),
                    
                TextColumn::make('title')
                    ->label('Judul Game')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('developer')
                    ->label('Pengembang')
                    ->searchable(),
                    
                TextColumn::make('platforms.name')
                    ->label('Platform')
                    ->badge(),
                    
                TextColumn::make('genres.name')
                    ->label('Genre')
                    ->badge()
                    ->color('success'),
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
