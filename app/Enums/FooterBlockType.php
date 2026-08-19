<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FooterBlockType: string implements HasLabel
{
    case Logo = 'logo';
    case Social = 'social';
    case Menu = 'menu';
    case Text = 'text';
    case Copyright = 'copyright';

    public function getLabel(): string
    {
        return match ($this) {
            self::Logo => 'Logo',
            self::Social => 'Redes sociales',
            self::Menu => 'Columna de menu',
            self::Text => 'Texto libre',
            self::Copyright => 'Copyright',
        };
    }

    /**
     * Alternativa por si tu version no resuelve el contrato HasLabel:
     * cambiar ->options(FooterBlockType::class) por
     * ->options(FooterBlockType::options()) en el formulario.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->getLabel()])
            ->all();
    }
}
