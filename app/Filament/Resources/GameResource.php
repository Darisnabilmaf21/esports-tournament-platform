<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
            Select::make('tournament_id')->relationship('tournament', 'name')->label('Turnamen')->required(),
            TextInput::make('round')->label('Babak (Contoh: Final)')->required(),
            Select::make('team_a_id')->relationship('teamA', 'name')->label('Tim A'),
            Select::make('team_b_id')->relationship('teamB', 'name')->label('Tim B'),
            TextInput::make('score_a')->numeric()->default(0)->label('Skor A'),
            TextInput::make('score_b')->numeric()->default(0)->label('Skor B'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('tournament.name')->label('Turnamen'),
            TextColumn::make('round')->label('Babak'),
            TextColumn::make('teamA.name')->label('Tim A'),
            TextColumn::make('score_a')->label('Skor A'),
            TextColumn::make('score_b')->label('Skor B'),
            TextColumn::make('teamB.name')->label('Tim B'),
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
