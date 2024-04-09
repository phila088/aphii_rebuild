<!DOCTYPE html>
{{--
    data-theme-mode: light or dark
    data-theme-color: primary color for theme
    data-nav-mode: vertical or horizontal
 --}}
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="ltr"
    data-nav-layout="vertical"
    data-theme-mode="light"
    data-header-styles="gradient"
    data-menu-styles="dark"
    data-nav-styl="menu-click"
    class=""
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('build/assets/img/logo/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('build/assets/img/logo/favicon.ico') }}" type="image/svg">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @livewireStyles

        @yield ('styles')

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/sass/app.scss',
            'resources/js/app.js'
        ])

        <script src="{{ asset('build/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('build/assets/libs/custom/main.js') }}" data-navigate-track></script>

    </head>
    <body class="font-sans antialiased" {{ Session::has('toast') ? 'data-notification data-notification-type="' . Session::get('toast-type') . '" datanotification-message="' . Session::get('toast') . '"' : '' }}>
        <div class="page">
            @livewire ('layout.header')

            @livewire ('layout.sidebar')

            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    <script>
        if (localStorage.getItem("velvetdarktheme")) {
            document.querySelector("html").setAttribute("data-theme-mode", "dark");
            document.querySelector("html").setAttribute("data-menu-styles", "dark");
            document.querySelector("html").setAttribute("data-header-styles", "gradient");
        }
        if (localStorage.velvetlayout) {
            let html = document.querySelector("html");
            html.setAttribute("data-nav-layout", "horizontal");
            document.querySelector("html").setAttribute("data-menu-styles", "gradient");
        }
        if (localStorage.getItem("velvetlayout") === "horizontal") {
            document.querySelector("html").setAttribute("data-nav-layout", "horizontal");
        }
        if (localStorage.loaderEnable === "true") {
            document.querySelector("html").setAttribute("loader", "enable");
        } else {
            if (!document.querySelector("html").getAttribute("loader")) {
                document.querySelector("html").setAttribute("loader", "disable");
            }
        }
    </script>
    </body>
</html>
