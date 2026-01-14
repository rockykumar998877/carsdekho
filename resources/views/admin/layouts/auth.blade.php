<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ !empty($title) ? $title . ' | ' . config('app.name', 'Laravel') : ' | ' . config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/scss/admin/admin.scss', 'resources/js/admin/admin.js'])
    @livewireStyles
</head>

<body>
    <div id="app">
        <main class="min-vh-100 d-flex align-items-center justify-content-center bg-light py-4">
           {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>

</html>
