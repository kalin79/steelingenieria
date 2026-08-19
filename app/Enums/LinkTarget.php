<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LinkTarget: string implements HasLabel
{
    case Self = '_self';
    case Blank = '_blank';

    public function getLabel(): string
    {
        return match ($this) {
            self::Self => 'Misma ventana',
            self::Blank => 'Ventana nueva',
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
