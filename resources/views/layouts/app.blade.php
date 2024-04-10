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
    data-vertical-style="default"
    data-nav-style="menu-click"
    class=""
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('build/assets/img/logo/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('build/assets/img/logo/favicon.svg') }}" type="image/svg">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @livewireStyles

        <link rel="stylesheet" href="{{ asset('build/assets/libs/toastr/build/toastr.min.css') }}">

        @yield ('styles')

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/scss/styles.scss',
            'resources/js/app.js'
        ])

    </head>
    <body class="font-sans antialiased" {{ Session::has('toast') ? 'data-notification data-notification-type="' . Session::get('toast-type') . '" datanotification-message="' . Session::get('toast') . '"' : '' }}>
        <div id="loader">
            <img src="{{ asset('build/assets/img/media/loader.svg') }}" alt="">
        </div>
        <div class="page">
            @livewire ('layout.header')

            @livewire ('layout.sidebar')

            <div class="page-header-breadcrumb md:flex block items-center justify-content-between ">
                @if (isset($title))
                    <h4 class="font-medium text-xl mb-0">
                        {{ $title }}
                    </h4>
                @endif

                @if (isset($breadcrumbs))
                    {{ $breadcrumbs }}
                @endif
            </div>

            <div class="main-content app-content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @vite('resources/libs/custom/custom-switcher.js')
        <script src="{{ asset('build/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('build/assets/libs/custom/main.js') }}"></script>
        <script src="{{ asset('build/assets/libs/toastr/build/toastr.min.js') }}"></script>
        <script src="{{ asset('build/assets/libs/pickr/pickr.es5.min.js') }}" data-navigate-track></script>
        <script src="{{ asset('build/assets/libs/popperjs/core/umd/popper.min.js') }}"></script>
    </body>
</html>
