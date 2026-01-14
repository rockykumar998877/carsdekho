<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Car Rental Service' }}</title>
    @vite(['resources/css/frontend/frontend.css', 'resources/js/frontend/frontend.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    @include('frontend.layouts.partials.header')
    
    <main>
        @yield('content')
    </main>

    @include('frontend.layouts.partials.footer')

    @stack('scripts')
</body>
</html>
