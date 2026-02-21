<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParallaxResource\Pages;
use App\Filament\Resources\ParallaxResource\RelationManagers;
use App\Models\Parallax;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParallaxResource extends Resource
{
    protected static ?string $model = Parallax::class;
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Efectos Parallax';

   public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Configuración del Efecto Parallax')
                    ->description('El título aparecerá sobre la imagen con el efecto de profundidad.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título del Parallax')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Innovación en cada paso'),

                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen de Fondo')
                            ->image()
                            ->directory('parallax')
                            ->required()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '21:9', // Proporción ideal para banners anchos
                            ])
                            ->helperText('Se recomienda usar imágenes de alta resolución (mínimo 1920px de ancho).'),
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

                // Previsualización de la imagen
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->width(200) // Un poco más ancha para ver el fondo
                    ->height(100),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título Flotante')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
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
            'index' => Pages\ListParallaxes::route('/'),
            'create' => Pages\CreateParallax::route('/create'),
            'edit' => Pages\EditParallax::route('/{record}/edit'),
        ];
    }
}
