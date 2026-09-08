<?php

namespace App\Support;

use App\Models\SiteSetting;

/**
 * Generadores de datos estructurados.
 *
 * Los datos estructurados son la señal de mayor confianza para los
 * sistemas generativos: es la unica parte de la pagina donde la empresa
 * declara en formato legible por maquina quien es, que hace y como
 * contactarla, sin que el modelo tenga que inferirlo del texto.
 */
class JsonLd
{
    /** Identidad de la empresa. Va en todas las paginas. */
    public static function organization(): array
    {
        $settings = SiteSetting::current();

        $datos = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => url('/').'#organization',
            'name' => $settings->site_name,
            'legalName' => $settings->legal_name,
            'url' => url('/'),
            'email' => $settings->email,
            'telephone' => $settings->phone,
        ];

        if ($settings->logo_header_url) {
            $datos['logo'] = $settings->logo_header_url;
        }

        if ($settings->address) {
            $datos['address'] = array_filter([
                '@type' => 'PostalAddress',
                'streetAddress' => $settings->address,
                'addressLocality' => $settings->city,
                'addressCountry' => $settings->country ?: 'PE',
            ]);
        }

        // Los perfiles de redes conectan la entidad del sitio con las
        // entidades de cada plataforma. Ayuda a resolver la identidad.
        $redes = \App\Models\SocialLink::active()->pluck('url')->all();

        if ($redes !== []) {
            $datos['sameAs'] = $redes;
        }

        return array_filter($datos);
    }

    /** Declara el sitio como tal. Habilita el enlace de sitio en Google. */
    public static function website(): array
    {
        $settings = SiteSetting::current();

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => url('/').'#website',
            'name' => $settings->site_name,
            'url' => url('/'),
            'inLanguage' => 'es-PE',
            'publisher' => ['@id' => url('/').'#organization'],
        ];
    }

    /**
     * Miga de pan. Google la usa para mostrar la ruta en el resultado
     * en vez de la URL cruda.
     *
     * @param  array<int, array{name: string, url: string}>  $items
     */
    public static function breadcrumb(array $items): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($items)
                ->map(fn (array $item, int $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $item['name'],
                    'item' => url($item['url']),
                ])
                ->all(),
        ];
    }

    /** Servicio concreto que presta la empresa. */
    public static function service(string $nombre, ?string $descripcion = null, ?string $area = null): array
    {
        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $nombre,
            'description' => $descripcion,
            'provider' => ['@id' => url('/').'#organization'],
            'areaServed' => $area,
        ]);
    }

    /**
     * Preguntas frecuentes.
     *
     * Es el esquema con mayor retorno para posicionamiento en IA: una
     * pregunta con su respuesta autocontenida es exactamente la unidad
     * que un asistente puede citar sin tener que resumir la pagina.
     *
     * @param  array<int, array{pregunta: string, respuesta: string}>  $faqs
     */
    public static function faq(array $faqs): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faqs)
                ->map(fn (array $faq) => [
                    '@type' => 'Question',
                    'name' => $faq['pregunta'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['respuesta'],
                    ],
                ])
                ->all(),
        ];
    }

    /**
     * Ficha de un proyecto ejecutado.
     *
     * Se usa CreativeWork y no Service: un proyecto es un trabajo ya
     * entregado, con cliente y fecha, no una prestacion que se ofrece.
     * Esa distincion es la que permite que un asistente responda "que
     * obras hizo esta empresa" citando la ficha correcta.
     */
    public static function project(
        string $nombre,
        ?string $descripcion = null,
        ?string $imagen = null,
        ?string $cliente = null,
        ?string $ejecucion = null,
        ?string $url = null,
    ): array {
        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $nombre,
            'description' => $descripcion,
            'image' => $imagen,
            'url' => $url,
            'creator' => ['@id' => url('/').'#organization'],
            'client' => $cliente,
            'temporalCoverage' => $ejecucion,
        ]);
    }
}
