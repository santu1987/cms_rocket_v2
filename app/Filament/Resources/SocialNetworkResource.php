<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialNetworkResource\Pages;
use App\Filament\Resources\SocialNetworkResource\RelationManagers;
use App\Models\SocialNetwork;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialNetworkResource extends Resource
{
    protected static ?string $model = SocialNetwork::class;

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationIcon = 'heroicon-o-share';
    protected static ?string $navigationLabel = 'Redes Sociales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Configuración de Red Social')
                    ->description('Introduce los datos del perfil social')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre de la Red')
                            ->required()
                            ->placeholder('Ej: Instagram, LinkedIn...'),
                        
                        Forms\Components\TextInput::make('description')
                            ->label('Descripción Corta')
                            ->placeholder('Ej: Perfil corporativo principal'),

                        Forms\Components\TextInput::make('link')
                            ->label('Enlace (URL)')
                            ->url() // Valida que sea un formato de URL válido
                            ->required()
                            ->placeholder('https://...'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ID Autonumérico
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Red Social')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(30),

                Tables\Columns\TextColumn::make('link')
                    ->label('Enlace')
                    ->icon('heroicon-m-link')
                    ->color('primary')
                    ->copyable() // Permite copiar el link rápido
                    ->url(fn ($record) => $record->link, true), // Abre el link en pestaña nueva al hacer clic
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSocialNetworks::route('/'),
            'create' => Pages\CreateSocialNetwork::route('/create'),
            'edit' => Pages\EditSocialNetwork::route('/{record}/edit'),
        ];
    }
}
