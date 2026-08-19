<?php

namespace App\Filament\Resources\SocialLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SocialLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon_url')
                    ->label('Icono')
                    ->getStateUsing(fn ($record) => $record->icon_url)
                    ->size(36)
                    ->square()
                    // Marca visualmente los registros a los que todavia
                    // les falta el icono, en vez de dejar la celda vacia.
                    ->defaultImageUrl(fn () => null),

                TextColumn::make('platform')
                    ->label('Red')
                    ->searchable()
                    ->description(fn ($record) => $record->iconMedia?->title ?: 'Sin archivo asociado'),

                TextColumn::make('url')
                    ->label('Enlace')
                    ->limit(45)
                    ->url(fn ($record) => $record->url, shouldOpenInNewTab: true)
                    ->color('primary'),

                TextColumn::make('label')
                    ->label('Texto alternativo')
                    ->limit(30)
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),
            ])
            ->reorderable('position')
            ->defaultSort('position')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
