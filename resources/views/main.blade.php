<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/sass/app.scss'])

</head>

<body>
    @include('layouts.app')

    @yield('content')

    @vite(['resources/js/app.js'])
</body>

</html>