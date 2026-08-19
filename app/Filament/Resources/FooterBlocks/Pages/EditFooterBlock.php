<?php

namespace App\Filament\Resources\FooterBlocks\Pages;

use App\Filament\Resources\FooterBlocks\FooterBlockResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFooterBlock extends EditRecord
{
    protected static string $resource = FooterBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
