<x-app-layout>
    @section('styles')

    @endsection
    @section ('title')
    Edit
    @endsection
    @section ('breadcrumbs')
        <x-breadcrumb-container>
            <x-breadcrumb-item label="Employee" url="#" />
            <x-breadcrumb-item label="Companies" url="{{ route('employee.companies.index') }}" />
            <x-breadcrumb-item-active label="{{ $company->name }}" />
        </x-breadcrumb-container>
    @endsection
    @section('content')
        <div class="flex flex-col w-full">
            <div class="card custom-card z-[10]">
                <div class="card-header flex justify-between">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="flex space-x-1" aria-label="Tabs" role="tablist" id="company-tabs">
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-4 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active" id="general-tab" data-hs-tab="#general" aria-controls="general" role="tab">
                                General
                            </button>
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-4 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="addresses-tab" data-hs-tab="#addresses" aria-controls="addresses" role="tab">
                                Addresses
                            </button>
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-4 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="emails-tab" data-hs-tab="#emails" aria-controls="emails" role="tab">
                                Emails
                            </button>
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-4 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="hours-tab" data-hs-tab="#hours" aria-controls="hours" role="tab">
                                Hours
                            </button>
                            <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-4 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="phone-numbers-tab" data-hs-tab="#phone-numbers" aria-controls="phone-numbers" role="tab">
                                Phone numbers
                            </button>
                        </nav>
                    </div>
                    <div>
                        <a href="#" class="btn-lime btn-sm rounded-md">Create</a>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div id="general" role="tabpanel" aria-labelledby="general">
                    <livewire:employee.companies.edit :company="$company" />
                </div>
                <div id="addresses" class="hidden" role="tabpanel" aria-labelledby="addresses">
                    <livewire:employee.company-addresses.list :company="$company"/>
                </div>
                <div id="emails" class="hidden" role="tabpanel" aria-labelledby="emails">
                    <p class="text-gray-500 dark:text-gray-400">
                        This is the <em class="font-semibold text-gray-800 dark:text-gray-200">third</em> item's tab body.
                    </p>
                </div>
                <div id="hours" class="hidden" role="tabpanel" aria-labelledby="hours">
                    <p class="text-gray-500 dark:text-gray-400">
                        This is the <em class="font-semibold text-gray-800 dark:text-gray-200">third</em> item's tab body.
                    </p>
                </div>
                <div id="phone-numbers" class="hidden" role="tabpanel" aria-labelledby="phone-numbers">
                    <p class="text-gray-500 dark:text-gray-400">
                        This is the <em class="font-semibold text-gray-800 dark:text-gray-200">third</em> item's tab body.
                    </p>
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

                    Livewire.on('error', () => {
                        toastr['error']('There was an unknown error, please try again.')
                    })
                    Livewire.on('company-edit', () => {
                        toastr['success']('Company successfully updated.')
                    })
                })
            </script>
        @endsection
</x-app-layout>
