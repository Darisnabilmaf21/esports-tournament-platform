<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TournamentResource\Pages;
use App\Filament\Resources\TournamentResource\RelationManagers;
use App\Models\Tournament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TournamentResource extends Resource
{
    protected static ?string $model = Tournament::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Nama Turnamen')
                ->required()
                ->maxLength(255),
            TextInput::make('game_title')
                ->label('Judul Game (contoh: Mobile Legends)')
                ->required()
                ->maxLength(255),
            TextInput::make('max_teams')
                ->label('Maksimal Tim')
                ->numeric()
                ->default(16)
                ->required(),
            DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required(),
            Select::make('status')
                ->options([
                    'registration' => 'Pendaftaran Dibuka',
                    'ongoing' => 'Sedang Berlangsung',
                    'completed' => 'Selesai',
                ])
                ->default('registration')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nama Turnamen')
                ->searchable()
                ->sortable(),
            TextColumn::make('game_title')
                ->label('Judul Game')
                ->searchable(),
            TextColumn::make('max_teams')
                ->label('Maks Tim')
                ->numeric(),
            TextColumn::make('start_date')
                ->label('Tanggal Mulai')
                ->date()
                ->sortable(),
            TextColumn::make('status')
                ->badge() // Membuat tampilan status menjadi seperti label berwarna
                ->color(fn (string $state): string => match ($state) {
                    'registration' => 'success', // Hijau
                    'ongoing' => 'warning',      // Kuning
                    'completed' => 'danger',     // Merah
                    }),
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
            'index' => Pages\ListTournaments::route('/'),
            'create' => Pages\CreateTournament::route('/create'),
            'edit' => Pages\EditTournament::route('/{record}/edit'),
        ];
    }
}
