<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos de acceso')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->helperText('Se muestra arriba a la derecha dentro del panel.')
                            ->required()
                            ->maxLength(120),

                        TextInput::make('email')
                            ->label('Correo')
                            ->helperText('Con este correo inicia sesion.')
                            ->email()
                            ->required()
                            ->maxLength(150)
                            // ignoreRecord evita que al editar un usuario
                            // choque contra su propio correo.
                            ->unique(ignoreRecord: true),

                        TextInput::make('password')
                            ->label('Contrasena')
                            ->password()
                            ->revealable()
                            ->minLength(8)
                            ->maxLength(60)
                            // Obligatoria solo al crear. Al editar, dejarla
                            // vacia significa "no la cambies".
                            ->required(fn (string $operation) => $operation === 'create')
                            ->helperText(fn (string $operation) => $operation === 'create'
                                ? 'Minimo 8 caracteres.'
                                : 'Dejala vacia para conservar la actual.')
                            // Sin esto, editar un usuario sin tocar el campo
                            // guardaria una contrasena vacia y lo dejaria
                            // afuera del panel.
                            ->dehydrated(fn (?string $state) => filled($state)),

                        Select::make('role')
                            ->label('Rol')
                            ->helperText('Por ahora solo existe Administrador, con acceso completo al panel.')
                            ->options(UserRole::class)
                            ->default(UserRole::Admin)
                            ->required()
                            ->native(false),

                        Toggle::make('is_active')
                            ->label('Cuenta activa')
                            ->helperText('Al desactivarla, la persona deja de poder entrar al panel en su siguiente clic, incluso si tiene la sesion abierta. Se prefiere desactivar antes que eliminar: borrar la cuenta borra tambien el registro de quien subio cada archivo a la biblioteca.')
                            ->default(true)
                            // No podes desactivarte a vos mismo: seria
                            // cerrarte la puerta desde adentro.
                            ->disabled(fn (?User $record) => $record?->getKey() === auth()->id())
                            ->dehydrated(),
                    ]),
            ]);
    }
}
