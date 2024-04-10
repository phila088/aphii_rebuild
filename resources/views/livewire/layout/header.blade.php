<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="javascript:void(0);" class="header-logo">
                        <img src="{{ asset('build/assets/img/logo/logo-full-color-trans-dark.svg') }}" alt="logo"
                             class="desktop-logo h-[37px]">
                        <img src="{{ asset('build/assets/img/logo/logo-icon-color-trans.svg') }}" alt="logo"
                             class="toggle-logo h-[37px]">
                        <img src="{{asset('build/assets/img/logo/logo-full-color-light-trans.svg')}}" alt="logo"
                             class="desktop-dark h-[37px]">
                        <img src="{{asset('build/assets/img/logo/logo-icon-color-trans.svg')}}" alt="logo"
                             class="toggle-dark">
                    </a>
                </div>

                <div class="header-element">
                    <!-- Start::header-link -->
                    <a aria-label="anchor" href="javascript:void(0);" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
                        <span class="open-toggle me-2">
                            <x-bx-menu class="header-link-icon" />
                        </span>
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">
            <div class="header-element header-theme-mode">
                <!-- Start::header-link|layout-setting -->
                <a aria-label="anchor" href="javascript:void(0);" class="header-link layout-setting">
                    <!-- Start::header-link-icon -->
                    <x-bx-sun class="header-link-icon ionicon dark-layout" />

                    <!-- End::header-link-icon -->
                    <!--  Start::header-link-icon -->
                    <x-bx-moon class="header-link-icon ionicon light-layout" />
                    <!-- End::header-link-icon -->
                </a>
                <!-- End::header-link|layout-setting -->
            </div>

            <!-- Start::header-element -->
            <div class="header-element header-fullscreen">
                <!-- Start::header-link -->
                <a aria-label="anchor" onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                    <x-bx-fullscreen class="header-link-icon full-screen-open" />
                    <x-bx-exit-fullscreen class="header-link-icon full-screen-close hidden" />
                </a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element mainuserProfile ms-[0.5rem]">
                <!-- Start::header-link|dropdown-toggle -->
                <div class="hs-dropdown h-100 relative inline-flex [--offset:1] [--placement:bottom-left] min-w-[calc(11rem+2px)] justify-center">
                    <a href="javascript:void(0)" class="hs-dropdown-toggle dropdown-toggle h-100 flex justify-center items-center px-2">
                        <div class="flex justify-center items-center">
                            <div class="avatar avatar-md">
                                @if(!empty(auth()->user()->profile_picture_path))
                                    <img alt="avatar" class="rounded-full" src="{{ asset(auth()->user()->profile_picture_path) }}">
                                @else
                                    <img
                                        alt="avatar"
                                        class="rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ str_replace(' ', '+', auth()->user()->name) }}&background=0D8ABC&color=fff&size=128&rounded=true&bold=true&format=svg" />
                                @endif
                            </div>
                            <div class="ms-2 my-auto d-none d-xl-flex">
                                <h6 class="font-semibold mb-0 text-[13px] user-name sm:block hidden">{{ Auth::user()->name }}</h6>
                            </div>
                        </div>
                    </a>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 -mt-4 hidden bg-white shadow-md rounded-b-lg border-t border-t-gray-100 dark:border dark:border-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:absolute before:start-0 before:w-full">
                        <ul class="border-0 main-header-dropdown  overflow-hidden header-profile-dropdown"
                            aria-labelledby="mainHeaderProfile">
                            <li class="border-b border-b-gray-100 hover:bg-gray-100/70">
                                <a class="dropdown-item flex items-center gap-x-1.5 px-3" href="{{ route('profile') }}">
                                    <x-bx-user class="size-[14px]" />
                                    Profile
                                </a>
                            </li>
                            <li class="border-b border-b-gray-100 hover:bg-gray-100/70">
                                <a class="dropdown-item flex items-center gap-x-1.5 px-3" href="javascript:void(0);">
                                    <x-bx-cog class="size-[14px] -mt-[2px]" />
                                    Settings
                                </a>
                            </li>
                            <li class="border-b border-b-gray-100 hover:bg-gray-100/70">
                                <a class="dropdown-item flex items-center gap-x-1.5 px-3" href="javascript:void(0);">
                                    <x-bx-help-circle class="size-[14px]" />
                                    Help
                                </a>
                            </li>
                            <li class="border-b border-b-gray-100 hover:bg-gray-100/70">
                                <a id="lock-app" class="dropdown-item flex items-center gap-x-1.5 px-3" href="{{ url('lockscreen') }}">
                                    <x-bx-lock class="size-[14px] -mt-[2px]" />
                                    Lock
                                </a>
                            </li>
                            <li class="border-b border-b-gray-100 hover:bg-gray-100/70">
                                <a class="dropdown-item flex items-center gap-x-1.5 px-3" href="javascript:void(0)" wire:click="logout">
                                    <x-bx-arrow-to-right class="size-[14px]" />
                                    Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End::header-element -->

            <div class="header-element">
                <!-- Start::header-link|switcher-icon -->
                <a aria-label="anchor" href="javascript:void(0);" class="header-link switcher-icon"
                   data-hs-overlay="#switcher-canvas">
                    <x-bx-cog class="bx-spin header-link-icon mx-[6px]" />
                </a>
                <!-- End::header-link|switcher-icon -->
            </div>
        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
