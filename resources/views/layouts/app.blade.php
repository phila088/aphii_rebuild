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

        <link rel="stylesheet" href="{{ asset('build/assets/icon-fonts/icons.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/libs/toastr/build/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/libs/flatpickr/flatpickr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/libs/pickr/themes/nano.min.css') }}">

        @yield ('styles')

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/sass/app.scss',
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

            <div class="page-header-breadcrumb flex items-center justify-between ">
                <h1 class="h1 text-white">
                    @yield ('title')
                </h1>
                <ol class="flex items-center whitespace-nowrap">
                    <li class="inline-flex items-center">
                        <a class="flex items-center text-xs text-gray-200 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500" href="#">
                            Home
                        </a>
                        <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </li>
                    <li class="inline-flex items-center">
                        <a class="flex items-center text-xs text-gray-200 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500" href="#">
                            App Center
                            <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="inline-flex items-center text-xs font-semibold text-blue-500 truncate dark:text-gray-200" aria-current="page">
                        Application
                    </li>
                </ol>
            </div>

            <div class="main-content app-content z-[75]">
                <div class="container-fluid">
                    @yield ('content')
                </div>
            </div>

            @livewire ('layout.footer')

            <div class="scrollToTop">
                <span class="arrow"><i class="ri-arrow-up-circle-fill fs-20"></i></span>
            </div>
            <div id="responsive-overlay"></div>
        </div>

        @vite('resources/libs/custom/custom-switcher.js')
        <script src="{{ asset('build/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('build/assets/libs/custom/main.js') }}"></script>
        <script src="{{ asset('build/assets/libs/toastr/build/toastr.min.js') }}"></script>
        <script src="{{ asset('build/assets/libs/pickr/pickr.es5.min.js') }}"></script>
        <script src="{{ asset('build/assets/libs/popperjs/core/umd/popper.min.js') }}"></script>
    <script>
        "use strict";
        (() => {
            window.addEventListener("scroll", stickyFn);

            var navbar = document.querySelector(".app-sidebar");
            var navbar1 = document.querySelector(".app-header");
            var sticky = navbar.offsetTop;

            // var sticky1 = navbar1.clientHeight;
            function stickyFn() {
                if (window.pageYOffset > sticky) {
                    navbar.classList.add("sticky");
                    navbar1.classList.add("sticky-pin");
                } else {
                    navbar.classList.remove("sticky");
                    navbar1.classList.remove("sticky-pin");
                }
            }
        })();

        window.addEventListener("unload", () => {
            // removing the scroll function
            window.addEventListener("scroll", stickyFn);
            window.addEventListener("DOMContentLoaded", stickyFn);
        });
    </script>
    </body>
</html>
