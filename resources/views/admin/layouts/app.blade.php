<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @vite(['resources/scss/admin/admin.scss', 'resources/js/admin/admin.js'])
</head>

<body>
    <div id="app">
        <main>
            @include('admin.layouts.partials.sidebar')
            <div id="layoutSidenav_content" class="main-content">
                @include('admin.layouts.partials.header')
                <div class="main-inner-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <main>
                                    @yield('content')
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('admin.layouts.partials.toast')
    @stack('scripts')
</body>

</html>
