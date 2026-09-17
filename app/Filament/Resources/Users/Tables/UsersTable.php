<?php

namespace App\Filament\Resources\Users\Tables;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->description(fn (User $record) => $record->email),

                TextColumn::make('role')
                    ->label('Rol')
                    ->badge(),

                // Se puede activar y desactivar desde el listado, sin
                // abrir la ficha: es la operacion mas frecuente de este
                // modulo y no justifica dos clics extra.
                ToggleColumn::make('is_active')
                    ->label('Activo')
                    ->disabled(fn (User $record) => ! self::sePuedeDesactivar($record))
                    ->beforeStateUpdated(function (User $record, bool $state) {
                        // El disabled() de arriba solo apaga el control en
                        // pantalla. Esta comprobacion es la que de verdad
                        // impide el cambio si la peticion llega por otra via.
                        if (! $state && ! self::sePuedeDesactivar($record)) {
                            throw new \RuntimeException('No se puede desactivar esta cuenta.');
                        }
                    }),

                TextColumn::make('created_at')
                    ->label('Alta')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),

                SelectFilter::make('role')
                    ->label('Rol')
                    ->options(UserRole::class),
            ])
            ->recordActions([
                EditAction::make(),

                DeleteAction::make()
                    ->visible(fn (User $record) => self::sePuedeEliminar($record))
                    ->before(function (User $record, DeleteAction $action) {
                        if (! self::sePuedeEliminar($record)) {
                            $action->cancel();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Nadie se desactiva a si mismo, y no se puede dejar al panel sin
     * ningun administrador activo: en cualquiera de los dos casos habria
     * que volver a la consola del servidor para recuperar el acceso.
     */
    private static function sePuedeDesactivar(User $record): bool
    {
        if ($record->getKey() === auth()->id()) {
            return false;
        }

        if (! $record->is_active) {
            // Ya esta inactivo: reactivarlo siempre se permite.
            return true;
        }

        if ($record->role !== UserRole::Admin) {
            return true;
        }

        return self::administradoresActivos() > 1;
    }

    /** Mismo criterio que desactivar: eliminar es aun mas irreversible. */
    private static function sePuedeEliminar(User $record): bool
    {
        if ($record->getKey() === auth()->id()) {
            return false;
        }

        if ($record->role !== UserRole::Admin) {
            return true;
        }

        return self::administradoresActivos() > 1;
    }

    private static function administradoresActivos(): int
    {
        return User::query()
            ->where('role', UserRole::Admin)
            ->where('is_active', true)
            ->count();
    }
}
