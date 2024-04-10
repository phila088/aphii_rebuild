<div id="switcher-canvas" class="offcanvas offcanvas-end hs-overlay hidden hs-overlay-open:ltr:translate-x-0 ltr:translate-x-full hs-overlay-open:rtl:translate-x-full rtl:translate-x-0 fixed top-0 end-0 transition-all duration-300 transform h-screen max-h-screen max-w-md w-full overflow-hidden z-[80] bg-white border-s dark:bg-gray-800 dark:border-gray-700 grid grid-flow-row-dense !gap-0 !grid-cols-1 auto-rows-auto" tabindex="-1">
    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white py-1">
            Switcher
        </h3>
        <button type="button" class="switcher-close" data-hs-overlay="#switcher-canvas">
            <span class="sr-only">Close modal</span>
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </button>
    </div>
    <nav class="flex space-x-1" aria-label="Tabs" role="tablist">
        <button type="button" class="switcher-tab active" id="tabs-with-underline-item-1" data-hs-tab="#tabs-with-underline-1" aria-controls="tabs-with-underline-1" role="tab">
            Theme styles
        </button>
        <button type="button" class="switcher-tab" id="tabs-with-underline-item-2" data-hs-tab="#tabs-with-underline-2" aria-controls="tabs-with-underline-2" role="tab">
            Theme colors
        </button>
    </nav>
    <div class="overflow-y-scroll">
        <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
            <div class="">
                <p class="switcher-style-head">Theme color mode:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="theme-style" class="radio" id="switcher-light-theme" checked>
                            <label for="switcher-light-theme" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Light</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="theme-style" class="radio" id="switcher-dark-theme">
                            <label for="switcher-dark-theme" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Dark</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Directions:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="direction" class="radio" id="switcher-ltr" checked>
                            <label for="switcher-ltr" class="text-xs text-gray-500 ms-2 dark:text-gray-400">LTR</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="direction" class="radio" id="switcher-rtl">
                            <label for="switcher-rtl" class="text-xs text-gray-500 ms-2 dark:text-gray-400">RTL</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Navigation styles:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-style" class="radio" id="switcher-vertical" checked>
                            <label for="switcher-vertical" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Vertical</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-style" class="radio" id="switcher-horizontal">
                            <label for="switcher-horizontal" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Horizontal</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Vertical & horizontal menu styles:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-menu-styles" class="radio" id="switcher-menu-click" checked>
                            <label for="switcher-menu-click" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Menu click</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-menu-styles" class="radio" id="switcher-menu-hover">
                            <label for="switcher-menu-hover" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Menu hover</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-menu-styles" class="radio" id="switcher-icon-click">
                            <label for="switcher-icon-click" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Icon click</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-menu-styles" class="radio" id="switcher-icon-hover">
                            <label for="switcher-icon-hover" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Icon hover</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Side menu layout styles:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-sidemenu-layout-styles" class="radio" id="switcher-default-menu" checked>
                            <label for="switcher-default-menu" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Default menu</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-sidemenu-layout-styles" class="radio" id="switcher-closed-menu">
                            <label for="switcher-closed-menu" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Closed menu</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-sidemenu-layout-styles" class="radio" id="switcher-icontext-menu">
                            <label for="switcher-icontext-menu" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Icon text</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-sidemenu-layout-styles" class="radio" id="switcher-icon-overlay">
                            <label for="switcher-icon-overlay" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Icon overlay</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-sidemenu-layout-styles" class="radio" id="switcher-detached">
                            <label for="switcher-detached" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Detached</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="navigation-sidemenu-layout-styles" class="radio" id="switcher-double-menu">
                            <label for="switcher-double-menu" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Double menu</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Page styles:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="page-styles" class="radio" id="switcher-regular" checked>
                            <label for="switcher-regular" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Regular</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="page-styles" class="radio" id="switcher-classic">
                            <label for="switcher-classic" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Classic</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Layout width styles:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="layout-width" class="radio" id="switcher-full-width" checked>
                            <label for="switcher-full-width" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Full width</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="layout-width" class="radio" id="switcher-boxed">
                            <label for="switcher-boxed" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Boxed</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Menu positions:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="menu-positions" class="radio" id="switcher-menu-fixed" checked>
                            <label for="switcher-menu-fixed" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Fixed</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="menu-positions" class="radio" id="switcher-menu-scroll">
                            <label for="switcher-menu-scroll" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Scrollable</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Header positions:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="header-positions" class="radio" id="switcher-header-fixed" checked>
                            <label for="switcher-header-fixed" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Fixed</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="header-positions" class="radio" id="switcher-header-scroll">
                            <label for="switcher-header-scroll" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Scrollable</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="header-positions" class="radio" id="switcher-header-rounded">
                            <label for="switcher-header-rounded" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Rounded</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Loader:</p>
                <div class="grid grid-cols-12 w-full switcher-style gx-0">
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="page-loader" class="radio" id="switcher-loader-enable" checked>
                            <label for="switcher-loader-enable" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Enable</label>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex">
                            <input type="radio" name="page-loader" class="radio" id="switcher-loader-disable">
                            <label for="switcher-loader-disable" class="text-xs text-gray-500 ms-2 dark:text-gray-400">Disable</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tabs-with-underline-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-underline-item-2">
            <div class="theme-colors">
                <p class="switcher-style-head">Menu colors:</p>
                <div class="flex switcher-style pb-2">
                    <div class="form-check switch-select me-3">
                        <input type="radio" class="form-check-input color-input color-white" title="Light menu" name="menu-colors" id="switcher-menu-light">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input type="radio" class="form-check-input color-input color-dark" title="Dark menu" name="menu-colors" id="switcher-menu-dark" checked>
                    </div>
                </div>
                <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Menu dynamically change
                    from below Theme Primary color picker
                </div>
            </div>
            <div class="theme-colors">
                <p class="switcher-style-head">Header &amp; Bredcrumb Colors:</p>
                <div class="flex switcher-style pb-2">
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Dark Header" type="radio" name="header-colors"
                               id="switcher-header-dark">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Color Header" type="radio" name="header-colors"
                               id="switcher-header-primary">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-gradient" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Gradient Header" type="radio" name="header-colors"
                               id="switcher-header-gradient">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-transparent" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Transparent Header" type="radio"
                               name="header-colors"
                               id="switcher-header-transparent">
                    </div>
                </div>
                <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Header dynamically
                    change from below Theme Primary color picker
                </div>
            </div>
            <div class="theme-colors">
                <p class="switcher-style-head">Header Colors:</p>
                <div class="flex switcher-style pb-2">
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Default Light Header" type="radio"
                               name="header-colors"
                               id="switcher-default-header-light">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Default Dark Header" type="radio"
                               name="header-colors"
                               id="switcher-default-header-dark">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Default Color Header" type="radio"
                               name="header-colors"
                               id="switcher-default-header-primary">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-gradient" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Default Gradient Header" type="radio"
                               name="header-colors"
                               id="switcher-default-header-gradient">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-transparent" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Default Transparent Header" type="radio"
                               name="header-colors"
                               id="switcher-default-header-transparent">
                    </div>
                </div>
                <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Header dynamically
                    change from below Theme Primary color picker
                </div>
            </div>
            <div class="theme-colors">
                <p class="switcher-style-head">Theme Primary:</p>
                <div class="flex flex-wrap align-items-center switcher-style">
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-1" type="radio"
                               name="theme-primary" id="switcher-primary">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-2" type="radio"
                               name="theme-primary" id="switcher-primary1">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-3" type="radio"
                               name="theme-primary"
                               id="switcher-primary2">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-4" type="radio"
                               name="theme-primary"
                               id="switcher-primary3">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-5" type="radio"
                               name="theme-primary"
                               id="switcher-primary4">
                    </div>
                    <div class="form-check switch-select ps-0 mt-1 color-primary-light">
                        <div class="theme-container-primary"></div>
                        <div class="pickr-container-primary"></div>
                    </div>
                </div>
            </div>
            <div class="theme-colors">
                <p class="switcher-style-head">Theme Background:</p>
                <div class="flex flex-wrap align-items-center switcher-style">
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-bg-1" type="radio"
                               name="theme-background" id="switcher-background">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-bg-2" type="radio"
                               name="theme-background" id="switcher-background1">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-bg-3" type="radio"
                               name="theme-background"
                               id="switcher-background2">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-bg-4" type="radio"
                               name="theme-background" id="switcher-background3">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-bg-5" type="radio"
                               name="theme-background" id="switcher-background4">
                    </div>
                    <div class="form-check switch-select ps-0 tooltip-static-demo color-bg-transparent">
                        <div class="theme-container-background"></div>
                        <div class="pickr-container-background"></div>
                    </div>
                </div>
            </div>
            <div class="menu-image mb-3">
                <p class="switcher-style-head">Menu With Background Image:</p>
                <div class="flex flex-wrap align-items-center switcher-style">
                    <div class="form-check switch-select m-2">
                        <input class="form-check-input bgimage-input bg-img1" type="radio"
                               name="theme-background" id="switcher-bg-img">
                    </div>
                    <div class="form-check switch-select m-2">
                        <input class="form-check-input bgimage-input bg-img2" type="radio"
                               name="theme-background" id="switcher-bg-img1">
                    </div>
                    <div class="form-check switch-select m-2">
                        <input class="form-check-input bgimage-input bg-img3" type="radio"
                               name="theme-background"
                               id="switcher-bg-img2">
                    </div>
                    <div class="form-check switch-select m-2">
                        <input class="form-check-input bgimage-input bg-img4" type="radio"
                               name="theme-background" id="switcher-bg-img3">
                    </div>
                    <div class="form-check switch-select m-2">
                        <input class="form-check-input bgimage-input bg-img5" type="radio"
                               name="theme-background" id="switcher-bg-img4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center p-2 border-t border-t-gray-100/70 shadow-inner">
        <a href="javascript:void(0);" id="reset-all" class="btn btn-amber btn-sm">Reset</a>
    </div>
</div>
