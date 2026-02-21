<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identificación y Categoría')
                    ->schema([
                        Forms\Components\Select::make('product_type_id')
                            ->label('Tipo de Producto')
                            ->relationship('productType', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('code')
                            ->label('Código Interno')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('title')
                            ->label('Nombre del Producto')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Comercialización')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Precio Base')
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01) // Permite decimales que el Setter convertirá a entero
                            ->required(),

                        Forms\Components\TextInput::make('d_price')
                            ->label('Precio con Descuento')
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01),

                        Forms\Components\Toggle::make('status')
                            ->label('Producto Activo')
                            ->default(true)
                            ->onColor('success')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Multimedia y Descripción')
                    ->schema([
                        Forms\Components\FileUpload::make('img')
                            ->label('Imagen del Producto')
                            ->image()
                            ->directory('img/products') // Ruta exacta solicitada
                            ->imageEditor()
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label('Descripción Detallada')
                            ->rows(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('img')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('productType.title')
                    ->label('Categoría')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money('USD') // El Getter lo devuelve como decimal, Filament lo formatea
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->label('Estado')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('product_type_id')
                    ->label('Categoría')
                    ->relationship('productType', 'title'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
