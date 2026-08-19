<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BlockWidth: string implements HasLabel
{
    case Column = 'column';
    case Full = 'full';

    public function getLabel(): string
    {
        return match ($this) {
            self::Column => 'Columna',
            self::Full => 'Fila completa',
        };
    }

    /** @return array<string, string> */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->getLabel()])
            ->all();
    }
}
