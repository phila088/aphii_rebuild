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
                        <nav class="flex space-x-1 overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500" aria-label="Tabs" role="tablist" id="company-tabs">
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
                            <button type="button" class="tab" id="note-tab" data-hs-tab="#note" aria-controls="note" role="tab">
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
                    <livewire:employee.client-calls.create :client="$client" />
                    <livewire:employee.client-calls.list :client="$client" />
                </div>
                <div id="contacts" class="hidden" role="tabpanel" aria-labelledby="contacts-tab">
                    <livewire:employee.client-contacts.create :client="$client" />
                    <livewire:employee.client-contacts.list :client="$client" />
                </div>
                <div id="contracts" class="hidden" role="tabpanel" aria-labelledby="contracts-tab">
                    <livewire:employee.client-contracts.create :client="$client" />
                    <livewire:employee.client-contracts.list :client="$client" />
                </div>
                <div id="note" class="hidden" role="tabpanel" aria-labelledby="note-tab">
                    <livewire:employee.client-notes.create :client="$client" />
                    <livewire:employee.client-notes.list :client="$client" />
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
                Livewire.on('client-edited', () => {
                    toastr['success']('Client successfully updated.')
                })
                Livewire.on('client-call-created', () => {
                    toastr['success']('Client call successfully created.')
                })
                Livewire.on('client-contact-created', () => {
                    toastr['success']('Client contact successfully created.')
                })
                Livewire.on('client-contact-deleted', () => {
                    toastr['success']('Client contact successfully deleted.')
                })
                Livewire.on('client-contract-created', () => {
                    toastr['success']('Client contract successfully created.')
                })
                Livewire.on('client-contract-deleted', () => {
                    toastr['success']('Client contract successfully deleted.')
                })
            })
        </script>
    @endsection
</x-app-layout>
