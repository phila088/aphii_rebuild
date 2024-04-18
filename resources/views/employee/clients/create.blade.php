<x-app-layout>
    @section('styles')

    @endsection
    @section ('title')
        Clients
    @endsection
    @section ('breadcrumbs')
        <x-breadcrumb-container>
            <x-breadcrumb-item label="Employee" url="#" />
            <x-breadcrumb-item label="Clients" url="{{ route('employee.clients.index') }}" />
            <x-breadcrumb-item-active label="Create" />
        </x-breadcrumb-container>
    @endsection
    @section('content')
        <div class="flex flex-col w-full">
            <div class="card custom-card">
                <div class="card-header flex justify-between">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="flex space-x-1" aria-label="Tabs" role="tablist">
                            <button type="button" class="tab active" id="tabs-with-underline-item-1" data-hs-tab="#tabs-with-underline-1" aria-controls="tabs-with-underline-1" role="tab">
                                Create
                            </button>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('employee.clients.index') }}" class="btn-red btn-sm rounded-md">Cancel</a>
                    </div>
                </div>
            </div>
            <livewire:employee.clients.create />
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

                Livewire.on('error', () => {
                    toastr['error']('There was an unknown error. Please try again.')
                })
            })
        </script>
    @endsection
</x-app-layout>
