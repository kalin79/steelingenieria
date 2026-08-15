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
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @inertia
</body>
</html>