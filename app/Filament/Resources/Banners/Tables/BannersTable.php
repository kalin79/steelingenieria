<?php

namespace App\Filament\Resources\Banners\Tables;

use App\Models\Banner;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BannersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imageDesktopMedia.path')
                    ->label('Escritorio')
                    ->disk('public')
                    ->height(40),

                TextColumn::make('title')
                    ->label('Titulo')
                    ->searchable()
                    ->description(fn (Banner $record) => $record->subtitle ?: null)
                    ->wrap(),

                TextColumn::make('collection')
                    ->label('Agrupacion')
                    ->badge()
                    ->placeholder('Sin agrupar')
                    ->searchable(),

                TextColumn::make('button_label')
                    ->label('Boton')
                    ->placeholder('Sin boton')
                    ->toggleable(),

                // Deja a la vista los banners a los que les falta la
                // version movil, que es el olvido mas frecuente.
                TextColumn::make('imagenes')
                    ->label('Imagenes')
                    ->state(function (Banner $record) {
                        $falta = [];

                        if (! $record->image_desktop_media_id) {
                            $falta[] = 'escritorio';
                        }

                        if (! $record->image_mobile_media_id) {
                            $falta[] = 'movil';
                        }

                        return $falta === [] ? 'Completo' : 'Falta '.implode(' y ', $falta);
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'Completo' ? 'success' : 'warning'),

                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),
            ])
            ->reorderable('position')
            ->defaultSort('position')
            ->filters([
                SelectFilter::make('collection')
                    ->label('Agrupacion')
                    ->options(fn () => Banner::query()
                        ->whereNotNull('collection')
                        ->distinct()
                        ->pluck('collection', 'collection')
                        ->all()),
            ])
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
