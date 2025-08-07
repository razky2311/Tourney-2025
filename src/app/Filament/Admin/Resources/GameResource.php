<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GameResource\Pages;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team1_id')
                    ->label('Team 1')
                    ->relationship('team1', 'name')
                    ->required(),

                Forms\Components\Select::make('team2_id')
                    ->label('Team 2')
                    ->relationship('team2', 'name')
                    ->required(),

                Forms\Components\Select::make('winner_id')
                    ->label('Winner')
                    ->relationship('winner', 'name')
                    ->nullable(),

                Forms\Components\DateTimePicker::make('game_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team1.name')->label('Team 1'),
                Tables\Columns\TextColumn::make('team2.name')->label('Team 2'),
                Tables\Columns\TextColumn::make('winner.name')->label('Winner'),
                Tables\Columns\TextColumn::make('game_date')->dateTime()->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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
