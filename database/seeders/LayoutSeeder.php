<?php

namespace Database\Seeders;

use App\Enums\BlockWidth;
use App\Enums\FooterBlockType;
use App\Enums\LinkTarget;
use App\Models\FooterBlock;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate([], [
            'site_name' => 'Steel Ingenieria',
            'legal_name' => 'Steel Ingenieria S.A.C.',
            'logo_header' => '/images/logo.svg',
            'logo_footer' => '/images/logo-footer.svg',
            'logo_alt' => 'Steel Ingenieria',
            'email' => 'contacto@steelingenieria.com',
            'phone' => '',
            'address' => '',
            'copyright' => '{year} Steel Ingenieria. Todos los derechos reservados.',
        ]);

        $redes = [
            ['platform' => 'LinkedIn', 'url' => '#', 'icon' => '/images/social/linkedin.svg', 'position' => 1],
            ['platform' => 'Facebook', 'url' => '#', 'icon' => '/images/social/facebook.svg', 'position' => 2],
            ['platform' => 'Instagram', 'url' => '#', 'icon' => '/images/social/instagram.svg', 'position' => 3],
        ];

        foreach ($redes as $red) {
            SocialLink::query()->updateOrCreate(
                ['platform' => $red['platform']],
                $red + ['is_active' => true, 'label' => "Steel Ingenieria en {$red['platform']}"]
            );
        }

        $this->menuHeader();
        $this->menusFooter();
        $this->bloquesFooter();
    }

    private function menuHeader(): void
    {
        $menu = Menu::query()->updateOrCreate(
            ['slug' => 'header'],
            ['name' => 'Navegacion principal', 'description' => 'Menu del header']
        );

        $menu->items()->delete();

        $servicios = $this->item($menu, 'Servicios', '/servicios', 2);

        $this->item($menu, 'Inicio', '/', 1);
        $this->item($menu, 'Montaje y mantenimiento metalico', '/servicios/montaje-y-mantenimiento-metalico', 1, $servicios->id);
        $this->item($menu, 'Master Mover', '/soluciones/master-mover', 3);
        $this->item($menu, 'Proyectos', '/proyectos', 4);
        $this->item($menu, 'Contactenos', '/contactenos', 5);
    }

    private function menusFooter(): void
    {
        $mapa = Menu::query()->updateOrCreate(
            ['slug' => 'footer-mapa-sitio'],
            ['name' => 'Mapa de sitio', 'description' => 'Columna del footer']
        );
        $mapa->items()->delete();
        $this->item($mapa, 'Inicio', '/', 1);
        $this->item($mapa, 'Quienes somos', '/quienes-somos', 2);
        $this->item($mapa, 'Proyectos', '/proyectos', 3);
        $this->item($mapa, 'Contactenos', '/contactenos', 4);

        $servicios = Menu::query()->updateOrCreate(
            ['slug' => 'footer-servicios'],
            ['name' => 'Servicios', 'description' => 'Columna del footer']
        );
        $servicios->items()->delete();
        $this->item($servicios, 'Montaje y mantenimiento metalico', '/servicios/montaje-y-mantenimiento-metalico', 1);

        $politicas = Menu::query()->updateOrCreate(
            ['slug' => 'footer-politicas'],
            ['name' => 'Politicas', 'description' => 'Columna del footer']
        );
        $politicas->items()->delete();
        $this->item($politicas, 'Terminos y condiciones', '/terminos-y-condiciones', 1);
        $this->item($politicas, 'Politica de privacidad', '/politica-de-privacidad', 2);
    }

    private function bloquesFooter(): void
    {
        FooterBlock::query()->delete();

        FooterBlock::query()->create([
            'type' => FooterBlockType::Logo,
            'width' => BlockWidth::Column,
            'column_span' => 3,
            'position' => 1,
        ]);

        foreach (['footer-mapa-sitio', 'footer-servicios', 'footer-politicas'] as $i => $slug) {
            $menu = Menu::query()->where('slug', $slug)->first();

            FooterBlock::query()->create([
                'type' => FooterBlockType::Menu,
                'title' => $menu?->name,
                'menu_id' => $menu?->id,
                'width' => BlockWidth::Column,
                'column_span' => 3,
                'position' => $i + 2,
            ]);
        }

        FooterBlock::query()->create([
            'type' => FooterBlockType::Social,
            'title' => 'Siguenos',
            'width' => BlockWidth::Full,
            'column_span' => 12,
            'position' => 5,
        ]);

        FooterBlock::query()->create([
            'type' => FooterBlockType::Copyright,
            'width' => BlockWidth::Full,
            'column_span' => 12,
            'position' => 6,
        ]);
    }

    private function item(Menu $menu, string $label, string $url, int $position, ?int $parentId = null): MenuItem
    {
        return MenuItem::query()->create([
            'menu_id' => $menu->id,
            'parent_id' => $parentId,
            'label' => $label,
            'url' => $url,
            'target' => LinkTarget::Self,
            'position' => $position,
            'is_active' => true,
        ]);
    }
}
