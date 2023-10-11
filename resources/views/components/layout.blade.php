<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        @vite('resources/css/app.css')
        @foreach (\App\Models\Font::get() as $font)
            <link rel="stylesheet" href="/stylesheets/{{ $font->file_for_all }}.css" />
        @endforeach
    </head>
    <body>
        <div class="container mx-auto p-8 space-y-8">
            {{ $slot }}
        </div>
    </body>
</html>
