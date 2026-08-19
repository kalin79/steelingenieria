<?php

namespace App\Filament\Resources\FooterBlocks\Pages;

use App\Filament\Resources\FooterBlocks\FooterBlockResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFooterBlocks extends ListRecords
{
    protected static string $resource = FooterBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
