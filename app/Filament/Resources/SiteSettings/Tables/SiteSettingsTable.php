<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_header_url')
                    ->label('Logo')
                    ->getStateUsing(fn ($record) => $record->logo_header_url)
                    ->height(36),

                TextColumn::make('site_name')
                    ->label('Nombre del sitio'),

                TextColumn::make('email')
                    ->label('Correo'),

                TextColumn::make('phone')
                    ->label('Telefono'),

                TextColumn::make('updated_at')
                    ->label('Ultima actualizacion')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            // Sin acciones masivas: es un registro unico, no hay nada que
            // seleccionar ni borrar en lote.
            ->toolbarActions([]);
    }
}
