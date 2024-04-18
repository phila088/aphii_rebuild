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
            <x-breadcrumb-item-active label="{{ $client->name }}" />
        </x-breadcrumb-container>
    @endsection
    @section('content')
        <div class="flex flex-col w-full">
            <div class="card custom-card z-[10]">
                <div class="card-header flex justify-between">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="flex space-x-1" aria-label="Tabs" role="tablist" id="company-tabs">
                            <button type="button" class="tab active" id="general-tab" data-hs-tab="#general" aria-controls="general" role="tab">
                                General
                            </button>
                            <button type="button" class="tab" id="billing-instructions-tab" data-hs-tab="#billing-instructions" aria-controls="addresses" role="tab">
                                Billing instructions
                            </button>
                            <button type="button" class="tab" id="calls-tab" data-hs-tab="#calls" aria-controls="calls" role="tab">
                                Calls
                            </button>
                            <button type="button" class="tab" id="contacts-tab" data-hs-tab="#contacts" aria-controls="contacts" role="tab">
                                Contacts
                            </button>
                            <button type="button" class="tab" id="contracts-tab" data-hs-tab="#contracts" aria-controls="contracts" role="tab">
                                Contracts
                            </button>
                            <button type="button" class="tab" id="notes-tab" data-hs-tab="#notes" aria-controls="notes" role="tab">
                                Notes
                            </button>
                            <button type="button" class="tab" id="onboarding-tab" data-hs-tab="#onboarding" aria-controls="onboarding" role="tab">
                                Onboarding
                            </button>
                            <button type="button" class="tab" id="portals-tab" data-hs-tab="#portals" aria-controls="portals" role="tab">
                                Portals
                            </button>
                            <button type="button" class="tab" id="rates-tab" data-hs-tab="#rates" aria-controls="rates" role="tab">
                                Rates
                            </button>
                            <button type="button" class="tab" id="service-charges-tab" data-hs-tab="#service-charges" aria-controls="service-charges" role="tab">
                                Service charges
                            </button>
                        </nav>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div id="general" role="tabpanel" aria-labelledby="general-tab">
                    <livewire:employee.clients.edit :client="$client" />
                </div>
                <div id="billing-instructions" class="hidden" role="tabpanel" aria-labelledby="billing-instructions-tab">
                    <livewire:employee.client-billing-instructions.create :client="$client" />
                </div>
                <div id="calls" class="hidden" role="tabpanel" aria-labelledby="calls-tab">
                    <livewire:employee.client-calls.list :client="$client" />
                    <livewire:employee.client-calls.create :client="$client" />
                </div>
                <div id="contacts" class="hidden" role="tabpanel" aria-labelledby="contacts-tab">
                    Contacts
                </div>
                <div id="contracts" class="hidden" role="tabpanel" aria-labelledby="contracts-tab">
                    Contracts
                </div>
                <div id="notes" class="hidden" role="tabpanel" aria-labelledby="notes-tab">
                    Notes
                </div>
                <div id="onboarding" class="hidden" role="tabpanel" aria-labelledby="onboarding-tab">
                    Onboarding
                </div>
                <div id="portals" class="hidden" role="tabpanel" aria-labelledby="portals-tab">
                    Portals
                </div>
                <div id="rates" class="hidden" role="tabpanel" aria-labelledby="rates-tab">
                    Rates
                </div>
                <div id="service-charges" class="hidden" role="tabpanel" aria-labelledby="service-charges-tab">
                    Service charges
                </div>
            </div>
        </div>
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
                Livewire.on('company-address-created', () => {
                    toastr['success']('Company address created successfully.')
                })
                Livewire.on('company-email-created', () => {
                    toastr['success']('Company email created successfully.')
                })
                Livewire.on('company-phone-created', () => {
                    toastr['success']('Company phone created successfully.')
                })
            })
        </script>
    @endsection
</x-app-layout>
