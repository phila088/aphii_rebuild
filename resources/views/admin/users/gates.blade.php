<x-app-layout>
    @section('styles')

    @endsection
    @section ('title')
        Gates
    @endsection
    @section ('breadcrumbs')
        <x-breadcrumb-container>
            <x-breadcrumb-item label="Admin" url="#" />
            <x-breadcrumb-item label="Users" url="{{ route('admin.users.index') }}" />
            <x-breadcrumb-item-active label="Gates" />
        </x-breadcrumb-container>
    @endsection
    @section('content')
        <div class="flex flex-col w-full">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="flex space-x-1" aria-label="Tabs" role="tablist" id="tabs">
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-3 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active" id="tabs-with-underline-item-1" data-hs-tab="#roles" aria-controls="roles" role="tab">
                                Roles
                            </button>
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-3 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="tabs-with-underline-item-2" data-hs-tab="#permissions" aria-controls="permissions" role="tab">
                                Permissions
                            </button>
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-3 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="tabs-with-underline-item-3" data-hs-tab="#role-permissions" aria-controls="role-permissions" role="tab">
                                Role Permissions
                            </button>
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-3 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="tabs-with-underline-item-4" data-hs-tab="#user-roles" aria-controls="user-roles" role="tab">
                                User Roles
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div id="roles" role="tabpanel" aria-labelledby="roles">
                    <livewire:admin.users.gates.roles />
                </div>
                <div id="permissions" class="hidden" role="tabpanel" aria-labelledby="permissions">
                    <livewire:admin.users.gates.permissions />
                </div>
                <div id="role-permissions" class="hidden" role="tabpanel" aria-labelledby="role-permissions">
                    <livewire:admin.users.gates.role-permissions />
                </div>
                <div id="user-roles" class="hidden" role="tabpanel" aria-labelledby="user-roles">
                    <livewire:admin.users.gates.user-roles />
                </div>
            </div>
        </div>
    @endsection

    @section ('scripts')
        <script>

            document.addEventListener('livewire:initialized', () => {

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "1000",
                    "hideDuration": "1000",
                    "timeOut": "10000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                Livewire.on('permissions-rebuilt', () => {
                    toastr['success']('Permissions fixed successfully.')
                })
            })
        </script>
    @endsection
</x-app-layout>
