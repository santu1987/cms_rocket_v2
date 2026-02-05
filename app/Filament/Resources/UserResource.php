<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form
        ->schema([
            Forms\Components\Section::make('Información de Usuario')
                ->description('Datos personales y de acceso')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre Completo')
                        ->required()
                        ->maxLength(255),
                    
                    Forms\Components\TextInput::make('email')
                        ->label('Correo Electrónico')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('password')
                        ->label('Contraseña')
                        ->password()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context): bool => $context === 'create'),

                    Forms\Components\FileUpload::make('avatar_url')
                        ->label('Foto de Perfil')
                        ->avatar()
                        ->directory('avatars')
                        ->imageEditor(),

                    Forms\Components\Select::make('role')
                        ->label('Rol del Sistema')
                        ->options([
                            'admin' => 'Administrador',
                            'editor' => 'Editor',
                        ])
                        ->default('editor')
                        ->required(),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Usuario Activo')
                        ->default(true)
                        ->color('success'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
       return $table
        ->columns([
            Tables\Columns\ImageColumn::make('avatar_url')
                ->label('Avatar')
                ->circular(),

            Tables\Columns\TextColumn::make('name')
                ->label('Nombre')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('email')
                ->label('Correo')
                ->searchable(),

            Tables\Columns\BadgeColumn::make('role')
                ->label('Rol')
                ->colors([
                    'danger' => 'admin',
                    'info' => 'editor',
                ]),

            Tables\Columns\IconColumn::make('is_active')
                ->label('Estado')
                ->boolean()
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Registro')
                ->dateTime('d/m/Y')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('role')
                ->options([
                    'admin' => 'Administrador',
                    'editor' => 'Editor',
                ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
