<?php

namespace App\Services;

use App\Models\FooterBlock;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Arma la estructura de header y footer que se comparte con Inertia.
 *
 * Todo el resultado se cachea: header y footer se renderizan en cada
 * pagina del sitio, asi que resolverlos contra la base en cada request
 * es costo de TTFB pagado en todas las visitas.
 */
class LayoutService
{
    private const CACHE_KEY = 'layout.payload';

    private const CACHE_TTL = 60 * 60 * 24; // 24 horas

    public function payload(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return [
                'settings' => $this->settings(),
                'social' => $this->socialLinks(),
                'headerMenu' => $this->menu('header'),
                'footerBlocks' => $this->footerBlocks(),
            ];
        });
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    private function settings(): array
    {
        $settings = SiteSetting::query()
            ->with(['logoHeaderMedia', 'logoFooterMedia'])
            ->firstOrCreate([]);

        return [
            'siteName' => $settings->site_name,
            'logoHeader' => $settings->logo_header_url,
            'logoFooter' => $settings->logo_footer_url,
            'logoAlt' => $settings->logo_alt_text,
            // Dimensiones del logo del header: permiten reservar el espacio
            // y evitar que el header salte al cargar.
            'logoHeaderWidth' => $settings->logoHeaderMedia?->width,
            'logoHeaderHeight' => $settings->logoHeaderMedia?->height,
            'email' => $settings->email,
            'phone' => $settings->phone,
            'whatsapp' => $settings->whatsapp,
            'address' => $settings->address,
            'copyright' => $settings->copyright_text,
        ];
    }

    private function socialLinks(): array
    {
        return SocialLink::active()
            ->with('iconMedia')
            ->get()
            ->map(fn (SocialLink $link) => [
                'platform' => $link->platform,
                'url' => $link->url,
                'icon' => $link->icon_url,
                'iconWidth' => $link->iconMedia?->width,
                'iconHeight' => $link->iconMedia?->height,
                'label' => $link->label ?: $link->platform,
            ])
            ->all();
    }

    /**
     * Devuelve el arbol completo de un menu con UNA sola consulta.
     * Se traen todos los items planos y el arbol se arma en memoria,
     * en vez de consultar los hijos de cada nivel por separado.
     */
    public function menu(string $slug): array
    {
        $menu = Menu::query()->where('slug', $slug)->first();

        if (! $menu) {
            return [];
        }

        $items = MenuItem::query()
            ->where('menu_id', $menu->id)
            ->where('is_active', true)
            ->orderBy('position')
            ->get();

        return $this->buildTree($items);
    }

    private function buildTree(Collection $items, ?int $parentId = null): array
    {
        return $items
            ->where('parent_id', $parentId)
            ->map(fn (MenuItem $item) => [
                'id' => $item->id,
                'label' => $item->label,
                'url' => $item->url,
                'target' => $item->target->value,
                'rel' => $item->rel_value,
                'isExternal' => $item->is_external,
                'children' => $this->buildTree($items, $item->id),
            ])
            ->values()
            ->all();
    }

    private function footerBlocks(): array
    {
        return FooterBlock::active()
            ->with('menu')
            ->get()
            ->map(function (FooterBlock $block) {
                return [
                    'id' => $block->id,
                    'type' => $block->type->value,
                    'title' => $block->title,
                    'content' => $block->content,
                    'width' => $block->width->value,
                    'columnSpan' => $block->column_span,
                    'items' => $block->menu
                        ? $this->menu($block->menu->slug)
                        : [],
                ];
            })
            ->all();
    }
}
