<x-app-layout>
    @section('styles')

    @endsection
    @section ('title')
        Users
    @endsection
    @section ('breadcrumbs')
        <x-breadcrumb-container>
            <x-breadcrumb-item label="Admin" url="#" />
            <x-breadcrumb-item-active label="Users" />
        </x-breadcrumb-container>
    @endsection
    @section('content')
        <div class="flex flex-col w-full">
        <div class="card custom-card">
            <div class="card-body">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex space-x-1 overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500" aria-label="Tabs" role="tablist">
                        <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active" id="tabs-with-underline-item-1" data-hs-tab="#tabs-with-underline-1" aria-controls="tabs-with-underline-1" role="tab">
                            Users
                        </button>
                        <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="tabs-with-underline-item-2" data-hs-tab="#tabs-with-underline-2" aria-controls="tabs-with-underline-2" role="tab">
                            Permissions
                        </button>
                        <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="tabs-with-underline-item-3" data-hs-tab="#tabs-with-underline-3" aria-controls="tabs-with-underline-3" role="tab">
                            Roles
                        </button>
                        <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="tabs-with-underline-item-3" data-hs-tab="#tabs-with-underline-3" aria-controls="tabs-with-underline-3" role="tab">
                            Role permissions
                        </button>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <div class="mt-3">
                    <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                        <livewire:user-table />
                    </div>
                    <div id="tabs-with-underline-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-underline-item-2">
                        <p class="text-gray-500 dark:text-gray-400">
                            This is the <em class="font-semibold text-gray-800 dark:text-gray-200">second</em> item's tab body.
                        </p>
                    </div>
                    <div id="tabs-with-underline-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-underline-item-3">
                        <p class="text-gray-500 dark:text-gray-400">
                            This is the <em class="font-semibold text-gray-800 dark:text-gray-200">third</em> item's tab body.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection
</x-app-layout>
