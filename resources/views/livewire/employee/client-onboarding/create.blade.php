<?php

use App\Models\Client;
use App\Models\Company;
use App\Models\PaymentTerm;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component
{
    public Client $client;

    public Collection $companies;
    public Collection $paymentTerms;

    #[Validate('required|integer|exists:companies,id')]
    public ?int $company_id = null;
    #[Validate('nullable|date')]
    public string $start_date = '';
    #[Validate('nullable|date')]
    public ?string $end_date = null;
    #[Validate('nullable|string')]
    public string $notes = '';
    #[Validate('nullable|integer')]
    public ?int $payment_term_id = null;
    #[Validate('nullable|boolean')]
    public bool $completed = false;

    public function mount(): void
    {
        $this->getCompanies();
        $this->getPaymentTerms();
    }

    public function getCompanies(): void
    {
        $this->companies = Company::get();
    }

    public function getPaymentTerms(): void
    {
        $this->paymentTerms = PaymentTerm::get();
    }

    public function store(): void
    {
        $this->authorize('clientOnboardings.create');

        $validated = $this->validate();

        $validated['client_id'] = $this->client->id;

        if ($clientOnboarding = auth()->user()->clientOnboardings()->create($validated)) {
            $this->dispatch('client-onboarding-created');

            $this->company_id = null;
            $this->start_date = '';
            $this->end_date = '';
            $this->notes = '';
            $this->payment_term_id = null;
            $this->completed = false;
        }
    }
}; ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    Create onboarding
                </h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="cols-3">
                        <label for="company-id" class="input-label">Company</label>
                        <select id="company-id" wire:model="company_id" class="input">
                            <option></option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-2">
                        <x-input type="date" id="start-date" model="start_date" label="Start date" />
                    </div>
                    <div class="cols-2">
                        <x-input type="date" id="end-date" model="end_date" label="End date" />
                    </div>
                    <div class="cols-2 flex items-center">
                        <x-checkbox id="complete" model="complete" label="Completed?" />
                    </div>
                    <div class="cols-12">
                        <x-cke id="onboarding-notes" model="notes" label="Notes"></x-cke>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="client-onboarding-create" />
            </div>
        </div>
    </form>
    @assets
    <script src="{{ asset('build/assets/libs/ckeditor/ckeditor.js') }}"></script>
    @endassets
    @script
    <script>
        let eEditor;
        const clientNotesEditor = await CKSource.Editor
            .create( document.querySelector( '#onboarding-notes' ), {
                removePlugins: ["MediaEmbedToolbar"],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'highlight', 'style',
                        '|', 'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'code', 'removeFormat',
                        '|', 'link', 'mediaEmbed', 'blockQuote', 'codeBlock', 'specialCharacters',
                        '|', 'insertTable',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'sourceEditing',
                    ],
                    shouldNotGroupWhenFull: false
                },
                autosave: {
                    save(editor) {
                        return saveData(editor.getData(), editor);
                    }
                },
                style: {
                    definitions: [
                        {
                            name: 'Info box',
                            element: 'p',
                            classes: ['info-box']
                        }
                    ],
                }
            } )
            .then ( editor => {
                eEditor = editor;
            } )
            .catch( handleSampleError );

        function handleSampleError( error ) {
            const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

            const message = [
                'Oops, something went wrong!',
                `Please, report the following error on ${ issueUrl } with the build id "y3r0qxylsb8q-2mlzsm176itn" and the error stack trace:`
            ].join( '\n' );

            console.error( message );
            console.error( error );
        }

        document.addEventListener('load', () => {
            eEditor.setData('{{ $notes }}')
        })

        function saveData(data, editor) {
            return new Promise(resolve => {
                setTimeout(() => {

                    $wire.notes = data

                    displayStatus(editor)

                    resolve();
                });
            });
        }

        // Update the "Status: Saving..." info.
        function displayStatus(editor) {
            const pendingActions = editor.plugins.get('PendingActions');
            const statusIndicator = document.querySelector('[autoloader^="container-"]');

            pendingActions.on('change:hasAny', (evt, propertyName, newValue) => {
                if (newValue) {
                    statusIndicator.classList.add('busy');
                } else {
                    statusIndicator.classList.remove('busy');
                }
            });
        }

        $wire.on('client-onboarding-created', () => {
            eEditor.setData('')
        })
    </script>
    @endscript
</div>
