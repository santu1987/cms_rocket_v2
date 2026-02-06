<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroResource\Pages;
use App\Filament\Resources\HeroResource\RelationManagers;
use App\Models\Hero;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\TernaryFilter;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    
    protected static ?string $navigationLabel = 'Banner Principal (Hero)';

   public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3) // Dividimos en 3 columnas para optimizar espacio
                    ->schema([
                        Section::make('Textos del Hero')
                            ->description('Gestiona los títulos principales')
                            ->schema([
                                Forms\Components\TextInput::make('titulo1')
                                    ->label('Título Superior')
                                    ->placeholder('Ej: Bienvenido'),
                                Forms\Components\TextInput::make('titulo2')
                                    ->label('Título Principal')
                                    ->required()
                                    ->placeholder('Ej: Rocket CMS v2'),
                                Forms\Components\TextInput::make('titulo3')
                                    ->label('Subtítulo')
                                    ->placeholder('Ej: Potenciado con Laravel 12'),
                                Forms\Components\TextInput::make('cta')
                                    ->label('Texto del Botón (CTA)')
                                    ->columnSpanFull(),
                            ])->columnSpan(2),

                        Section::make('Estado y Configuración')
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->label('¿Visible en la web?')
                                    ->default(true)
                                    ->onColor('success'),
                            ])->columnSpan(1),
                    ]),

                Section::make('Multimedia')
                    ->description('Carga los archivos visuales del Hero')
                    ->schema([
                        Forms\Components\FileUpload::make('img')
                            ->label('Imagen de Fondo')
                            ->image() // Solo permite imágenes
                            ->directory('hero-images')
                            ->imageEditor(), // Permite recortar la imagen desde el panel
                        
                        Forms\Components\FileUpload::make('video')
                            ->label('Video de Fondo')
                            ->directory('hero-videos')
                            ->acceptedFileTypes(['video/mp4', 'video/ogg', 'video/webm'])
                            ->maxSize(10240), // Límite de 10MB para no saturar el servidor
                    ])->columns(2),
            ]);
    }

   public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Campo autonumérico (ID)
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('titulo2')
                    ->label('Título Principal')
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('Estado'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('status')
                    ->label('Estado de Visibilidad')
                    ->placeholder('Todos los estados')
                    ->trueLabel('Solo Visibles')
                    ->falseLabel('Solo Ocultos')
                    ->queries(
                        true: fn ($query) => $query->where('status', true),
                        false: fn ($query) => $query->where('status', false),
                    ),
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
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}
