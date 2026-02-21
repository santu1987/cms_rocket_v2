<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterResource\Pages;
use App\Filament\Resources\FooterResource\RelationManagers;
use App\Models\Footer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Pie de Página (Footer)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Títulos de Columnas')
                    ->description('Define los encabezados de las tres secciones del pie de página')
                    ->schema([
                        Forms\Components\TextInput::make('title1')->label('Título Columna 1'),
                        Forms\Components\TextInput::make('title2')->label('Título Columna 2'),
                        Forms\Components\TextInput::make('title3')->label('Título Columna 3'),
                    ])->columns(3),

                Forms\Components\Section::make('Información de Contacto y Legal')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email(),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Teléfono')
                            ->tel(),
                        Forms\Components\TextInput::make('rif')
                            ->label('RIF / Identificación Fiscal')
                            ->placeholder('Ej: J-12345678-9'),
                        Forms\Components\Toggle::make('status')
                            ->label('Footer Activo')
                            ->default(true)
                            ->onColor('success'),
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

                Tables\Columns\TextColumn::make('title1')
                    ->label('Título 1')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email de Contacto')
                    ->copyable(), // Permite copiar el email haciendo clic

                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Teléfono'),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('Estado'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro por estado
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Estado'),
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
            'index' => Pages\ListFooters::route('/'),
            'create' => Pages\CreateFooter::route('/create'),
            'edit' => Pages\EditFooter::route('/{record}/edit'),
        ];
    }
}
