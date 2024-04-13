<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    //
}; ?>

<aside class="app-sidebar" id="sidebar">

    <!-- Logos -->
    <div class="main-sidebar-header">
        <a href="javascript:void(0);" class="header-logo">
            <img src="{{ asset('build/assets/img/logo/logo-full-color-trans.svg') }}" alt="logo"
                 class="desktop-logo h-[37px]">
            <img src="{{ asset('build/assets/img/logo/logo-icon-color-trans.svg') }}" alt="logo"
                 class="toggle-logo h-[37px]">
            <img src="{{asset('build/assets/img/logo/logo-full-color-trans.svg')}}" alt="logo"
                 class="desktop-dark h-[37px]">
            <img src="{{asset('build/assets/img/logo/logo-icon-color-trans.svg')}}" alt="logo"
                 class="toggle-dark">
        </a>
    </div>

    <!-- Container -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">

            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>

            {{-- Employee menu --}}
            <ul class="main-menu">

                <li class="slide">
                    <a href="{{ route('dashboard') }}" class="side-menu__item">
                        <span class="side-menu__icon">
                            <i class="bi bi-speedometer"></i>
                        </span>
                        <span class="side-menu__label mt-[0.2rem]">
                            Dashboard
                        </span>
                    </a>
                </li>

                @canany (['companies.viewAny', 'companies.create'])
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="bi bi-building"></i>
                            </span>
                            <span class="side-menu__label mt-[0.3rem]">
                                Companies
                            </span>
                            <i class="fe fe-chevron-right side-menu__angle tw-mt-[0.3rem]"></i>
                        </a>
                        @canany (['companies.viewAny', 'companies.create'])
                            <ul class="slide-menu child2">
                                @can ('companies.viewAny')
                                    <li class="slide">
                                        <a href="{{ route('employee.companies.index') }}" class="side-menu__item">
                                            <span class="side-menu__label">
                                                View
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can ('companies.create')
                                    <li class="slide">
                                        <a href="{{ route('employee.companies.create') }}" class="side-menu__item">
                                            <span class="side-menu__label">
                                                Create
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        @endcanany
                    </li>
                @endcanany

                <li class="slide__category"><span class="category-name"><hr /></span></li>

                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <span class=" side-menu__icon">
                            <i class="bi bi-sliders"></i>
                        </span>
                        <span class="side-menu__label mt-[0.3rem]">
                            Admin
                        </span>
                        <i class="fe fe-chevron-right side-menu__angle tw-mt-[0.3rem]"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="side-menu__label">
                                    Links
                                </span>
                                <i class="fe fe-chevron-right side-menu__angle tw-mt-[0.3rem]"></i>
                            </a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="https://rebuild.aphii.co/pulse" target="_blank" class="side-menu__item">
                                        <span class="side-menu__label">
                                            Pulse
                                        </span>
                                    </a>
                                </li>
                                <li class="slide">
                                    <a href="https://rebuild.aphii.co/telescope" target="_blank" class="side-menu__item">
                                        <span class="side-menu__label">
                                            Telescope
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="side-menu__label">
                                    Users
                                </span>
                                <i class="fe fe-chevron-right side-menu__angle tw-mt-[0.3rem]"></i>
                            </a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="{{ route('admin.users.gates') }}" class="side-menu__item">
                                        <span class="side-menu__label">
                                            Gates
                                        </span>
                                    </a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.users.index') }}" class="side-menu__item">
                                        <span class="side-menu__label">
                                            View
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
