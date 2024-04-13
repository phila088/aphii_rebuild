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
            <div class="card custom-card z-[10]">
                <div class="card-header flex justify-between">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="flex space-x-1" aria-label="Tabs" role="tablist">
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-3 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active" id="tabs-with-underline-item-1" data-hs-tab="#tabs-with-underline-1" aria-controls="tabs-with-underline-1" role="tab">
                                All users
                            </button>
                        </nav>
                    </div>
                    <div>
                        <a href="#" class="btn-lime btn-sm rounded-md">Create</a>
                    </div>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <livewire:user-table />
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
