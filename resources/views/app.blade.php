@php
    // Inertia expone las props de la pagina en la vista raiz. Esto solo
    // se ejecuta en la carga inicial, que es justamente la que ven los
    // rastreadores: las navegaciones posteriores son peticiones XHR y no
    // vuelven a pasar por este archivo.
    $seo = $page['props']['seo'] ?? [];

    $titulo = $seo['title'] ?? config('app.name');
    $descripcion = $seo['description'] ?? null;
    $keywords = $seo['keywords'] ?? null;
    $canonical = $seo['canonical'] ?? url()->current();
    $imagen = $seo['image'] ?? null;
    $robots = $seo['robots'] ?? 'index, follow';
    $tipo = $seo['type'] ?? 'website';
    $nombreSitio = $seo['siteName'] ?? config('app.name');
    $esquemas = $seo['schemas'] ?? [];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Preload la fuente más importante (regular) -->
    <link 
        rel="preload" 
        href="/fonts/barlow/Barlow-Regular.woff2" 
        as="font" 
        type="font/woff2" 
        crossorigin
    >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- ============ SEO BASICO ============ --}}
    <title>{{ $titulo }}</title>

    @if ($descripcion)
        <meta data-inertia="description" name="description" content="{{ $descripcion }}">
    @endif

    @if ($keywords)
        <meta data-inertia="keywords" name="keywords" content="{{ $keywords }}">
    @endif

    <link data-inertia="canonical" rel="canonical" href="{{ $canonical }}">
    <meta data-inertia="robots" name="robots" content="{{ $robots }}">

    {{-- ============ OPEN GRAPH ============ --}}
    {{-- Lo que se ve al compartir el enlace en WhatsApp, LinkedIn y
         Facebook. Sin esto el enlace aparece pelado y baja el clic. --}}
    <meta data-inertia="og:type" property="og:type" content="{{ $tipo }}">
    <meta data-inertia="og:site_name" property="og:site_name" content="{{ $nombreSitio }}">
    <meta data-inertia="og:title" property="og:title" content="{{ $titulo }}">
    <meta data-inertia="og:url" property="og:url" content="{{ $canonical }}">
    <meta data-inertia="og:locale" property="og:locale" content="{{ $seo['locale'] ?? 'es_PE' }}">

    @if ($descripcion)
        <meta data-inertia="og:description" property="og:description" content="{{ $descripcion }}">
    @endif

    @if ($imagen)
        <meta data-inertia="og:image" property="og:image" content="{{ $imagen }}">
        <meta data-inertia="og:image:width" property="og:image:width" content="1200">
        <meta data-inertia="og:image:height" property="og:image:height" content="630">
    @endif

    {{-- ============ TWITTER / X ============ --}}
    <meta data-inertia="twitter:card" name="twitter:card" content="{{ $imagen ? 'summary_large_image' : 'summary' }}">
    <meta data-inertia="twitter:title" name="twitter:title" content="{{ $titulo }}">

    @if ($descripcion)
        <meta data-inertia="twitter:description" name="twitter:description" content="{{ $descripcion }}">
    @endif

    @if ($imagen)
        <meta data-inertia="twitter:image" name="twitter:image" content="{{ $imagen }}">
    @endif

    {{-- ============ DATOS ESTRUCTURADOS ============ --}}
    {{-- Van en el HTML servido, no inyectados por JavaScript: es la
         unica forma de que los rastreadores de IA los lean. --}}
    <script type="application/ld+json">
        {!! json_encode(\App\Support\JsonLd::organization(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>

    <script type="application/ld+json">
        {!! json_encode(\App\Support\JsonLd::website(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>

    @foreach ($esquemas as $esquema)
        <script type="application/ld+json">
            {!! json_encode($esquema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endforeach

    {{-- ============ ICONOS Y FUENTES ============ --}}
    <link rel="icon" href="/favicon.ico" sizes="any">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>