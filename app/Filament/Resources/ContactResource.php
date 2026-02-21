<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationLabel = 'Mensajes de Contacto';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalle del Mensaje')
                    ->description('Información enviada desde el formulario de contacto')
                    ->schema([
                        Forms\Components\TextInput::make('nombres')
                            ->readonly(), // Evita cambios accidentales
                        Forms\Components\TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->readonly(),
                        Forms\Components\TextInput::make('telefono')
                            ->label('Teléfono de contacto')
                            ->readonly(),
                        Forms\Components\TextInput::make('razon')
                            ->label('Motivo / Razón')
                            ->columnSpanFull()
                            ->readonly(),
                        Forms\Components\Textarea::make('mensaje')
                            ->label('Contenido del mensaje')
                            ->rows(5)
                            ->columnSpanFull()
                            ->readonly(),
                    ])->columns(3),
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

                Tables\Columns\TextColumn::make('nombres')
                    ->label('Nombre Cliente')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('razon')
                    ->label('Asunto')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Envío')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') // Los más recientes primero
            ->filters([
                Tables\Filters\SelectFilter::make('razon')
                    ->label('Filtrar por Razón')
                    ->options([
                        'Ventas' => 'Ventas',
                        'Soporte' => 'Soporte',
                        'Información' => 'Información General',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Botón de "Ver" para leer el mensaje completo
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
