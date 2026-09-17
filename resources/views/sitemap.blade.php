{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
{{-- La declaracion XML se imprime con {!! !!} porque Blade la tomaria
     como una etiqueta de apertura de PHP y no llegaria a la salida. --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
@if (! empty($url['lastmod']))
        <lastmod>{{ $url['lastmod'] }}</lastmod>
@endif
    </url>
@endforeach
</urlset>
