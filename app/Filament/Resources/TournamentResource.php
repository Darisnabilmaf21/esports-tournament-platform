<?php

namespace App\Filament\Resources;

use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\TournamentResource\Pages;
use App\Filament\Resources\TournamentResource\RelationManagers;
use App\Models\Tournament;
use Filament\Forms;
use Filament\Forms\Form;
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
               TextInput::make('title')
                 ->label('Nama Turnamen')
                 ->required()
                 ->maxLength(255)
                 ->live(onBlur: true)
                 ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

             TextInput::make('slug')
                 ->label('Slug (URL)')
                 ->required()
                 ->maxLength(255)
                 ->unique(ignoreRecord: true),

                 Select::make('game_id')
                 ->label('Game yang Dipertandingkan')
                 ->relationship('game', 'title')
                 ->required()
                 ->searchable()
                 ->preload(),

                 Select::make('organizer_id')
                    ->label('Penyelenggara')
                    ->relationship('organizer', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

             DateTimePicker::make('start_date')
                 ->label('Tanggal & Waktu Mulai')
                 ->required(),

             DateTimePicker::make('end_date')
                 ->label('Tanggal & Waktu Selesai')
                 ->required(),

                Select::make('status')
                    ->label('Status Turnamen')
                    ->options([
                        'pending' => 'Menunggu Persetujuan (Pending)',
                        'approved' => 'Disetujui / Akan Datang (Approved)',
                        'rejected' => 'Ditolak (Rejected)',
                        'ongoing' => 'Sedang Berjalan (Ongoing)',
                        'completed' => 'Selesai (Completed)',
                    ])
                    ->required()
                    ->default('pending'), // Default disesuaikan dengan aturan database

             Textarea::make('description')
                 ->label('Deskripsi Turnamen')
                 ->columnSpanFull(),
         ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organizer_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('game_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
