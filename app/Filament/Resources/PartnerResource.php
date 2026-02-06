<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalles del Partner')
                    ->description('Configura la información de tu aliado comercial')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->placeholder('Ej: Socio tecnológico desde 2020...')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('imagen')
                            ->label('Logo del Partner')
                            ->image() // Valida que sea imagen
                            ->directory('partners') // Se guarda en storage/app/public/partners
                            ->required()
                            ->imageEditor() // Para que puedas recortar el logo si es muy grande
                            ->columnSpanFull(),
                    ]),
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

                // Logo del Partner
                Tables\Columns\ImageColumn::make('imagen')
                    ->label('Logo')
                    ->square(), // Los logos suelen verse mejor cuadrados o en su proporción original

                // Descripción (limitada para que no rompa la tabla)
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50) // Solo muestra los primeros 50 caracteres
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Agregado el')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
