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

            <!-- Employee Menu -->
            <ul class="main-menu">
                <!-- Main category -->
                <x-slide-category label="Main" />

                <!-- Dashboards -->
                <li class="slide">
                    <a href="{{ route('dashboard') }}" class="side-menu__item">
                        <span class="side-menu__icon">
                            <x-bx-home />
                        </span>
                        <span class="side-menu__label">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <span class=" side-menu__icon">
                            <x-bx-dollar />
                        </span>
                        <span class="side-menu__label tw-mt-[0.4rem]">
                            Accounting
                        </span>
                        <x-feathericon-chevron-right class="side-menu__angle tw-mt-[0.3rem]" />
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="#" class="side-menu__item">
                                <span class="side-menu__label">
                            Dashboard
                        </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Accounting -->
                <x-slide-parent icon="bi bi-bank" label="Accounting">
                    <x-slide-label label="Accounting" />

                    <x-slide-with-child label="Payables">
                        <x-slide-item route="url:#" label="Awaiting invoice" />

                        <x-slide-item route="url:#" label="Enter payment" />

                        <x-slide-item route="url:#" label="On-hold" />

                        <x-slide-item route="url:#" label="Pending invoices" />

                        <x-slide-item route="url:#" label="Paid" />

                        <x-slide-item route="url:#" label="Reports" />
                    </x-slide-with-child>

                    <x-slide-with-child label="Receivables">
                        <x-slide-item route="url:#" label="Awaiting submission" />

                        <x-slide-item route="url:#" label="Create invoice" />

                        <x-slide-item route="url:#" label="Enter payment" />

                        <x-slide-item route="url:#" label="Pending payment" />

                        <x-slide-item route="url:#" label="Paid" />

                        <x-slide-item route="url:#" label="Purgatory" />

                        <x-slide-item route="url:#" label="Reports" />
                    </x-slide-with-child>

                </x-slide-parent>
                <x-slide-parent icon="bi bi-building" label="Brands">
                    <x-slide-label label="Brands" />

                    <x-slide-item route="url:#" label="View all" />

                    <x-slide-item route="url:javascript:void(0);" label="Reports" />
                </x-slide-parent>
                <x-slide-parent icon="bi bi-people" label="Clients">
                    <x-slide-label label="Clients" />

                    <x-slide-item route="url:#" label="View all" />

                    <x-slide-item route="url:#" label="Reports" permission="client.generateReport" />
                </x-slide-parent>

                <!-- Quote -->
                <x-slide-parent icon="bi bi-pencil" label="Quoting">
                    <x-slide-label label="Quoting" />

                    <x-slide-with-child label="Catalog">
                        <x-slide-item route="url:#" label="View all" />

                        <x-slide-item route="url:#" label="Create" />
                    </x-slide-with-child>

                    <x-slide-item route="url:#" label="Create" />

                    <x-slide-item route="url:#" label="Pending" />

                    <x-slide-item route="url:#" label="Revisions" />
                </x-slide-parent>


                <!-- Vendors -->
                <x-slide-parent icon="bi bi-hammer" label="Vendors">
                    <x-slide-label label="Vendors" />

                    <x-slide-item route="url:#" label="View all" />

                    <x-slide-item route="url:#" label="Create" />

                </x-slide-parent>

                <!-- Work orders -->
                <x-slide-parent icon="bi bi-cone-striped" label="Work orders">
                    <x-slide-label label="Work orders" />

                    <x-slide-item route="url:#" label="View all" />

                    <x-slide-item route="url:#" label="Create" />

                </x-slide-parent>

                <x-slide-category label="Misc" />

                <!-- Documents -->
                <x-slide-parent icon="bi bi-file-earmark" label="Documents">
                    <x-slide-label label="Documents" />

                    <x-slide-item route="url:#" label="View all" />

                    <x-slide-item route="url:#" label="Upload" />

                </x-slide-parent>

                <!-- Web apps category -->
                <li class="slide__category"><span class="category-name">Web Apps</span></li>

                <!-- CRM -->
                <x-slide-parent icon="bi bi-person-rolodex" label="CRM">
                    <x-slide-label label="CRM" />

                    <x-slide-with-child label="Calls">

                        <x-slide-item route="url:#" label="View all" />

                        <x-slide-item route="url:#" label="Create" />

                    </x-slide-with-child>

                    <x-slide-with-child label="Contacts">

                        <x-slide-item route="url:#" label="View all" />

                        <x-slide-item route="url:#" label="Create" />

                        <x-slide-item route="url:#" label="Import" />

                    </x-slide-with-child>

                    <x-slide-with-child label="Loops">

                        <x-slide-item route="url:#" label="View all" />

                        <x-slide-item route="url:#" label="Create" />

                    </x-slide-with-child>

                </x-slide-parent>

                <!-- KB -->
                <x-slide-parent icon="bi bi-chat-left-quote" label="Knowledge base">
                    <x-slide-item route="url:#" label="Articles" />

                    <x-slide-item route="url:#" label="Courses" />

                    <x-slide-item route="url:#" label="Request an article" />

                </x-slide-parent>

                <!-- Settings category -->
                <li class="slide__category"><span class="category-name">User</span></li>

                <!-- User settings -->
                <x-slide-parent icon="bi bi-gear" label="User">
                    <x-slide-label label="User" />

                    <x-slide-item route="url:#" label="Account" />

                    <x-slide-item route="url:#" label="Site" />

                </x-slide-parent>

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
