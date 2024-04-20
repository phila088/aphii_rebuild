<?php

use App\Models\Client;
use App\Models\ClientContact;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component
{
    public Client $client;
    public Collection $clientContacts;

    #[Validate('nullable|int')]
    public int $client_id;
    #[Validate('nullable|int')]
    public ?int $client_contact_id;
    #[Validate('required|string')]
    public ?string $call_date;
    #[Validate('required|string')]
    public string $notes;

    public function mount(): void
    {
        $this->getClientContacts();

        $this->client_id = $this->client->id;
    }

    #[On('client-contact-created')]
    public function getClientContacts($clientId = null): void
    {
        $this->clientContacts = ClientContact::where('client_id', $this->client->id)
            ->get();
    }

    public function store(): void
    {
        $this->authorize('clientCalls.create');

        $this->call_date = Carbon::parse($this->call_date . ' ' . auth()->user()->userProfile->timezone)->setTimezone(config('app.timezone'))->format('Y-m-d H:i:s');

        $validated = $this->validate();

        if ($clientCall = auth()->user()->clientCalls()->create($validated)) {
            $this->dispatch('client-call-created');

            $this->client_contact_id = null;
            $this->call_date = null;
            $this->notes = '';
        }
    }
}; ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    Create a call
                </h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="cols-3">
                        <label for="client-contact-id" class="input-label">Contact</label>
                        <select id="client-contact-id" wire:model="client_contact_id" class="input">
                            <option></option>
                            @if (!empty($clientContacts))
                                @foreach ($clientContacts as $clientContact)
                                    <option value="{{ $clientContact->id }}">{{ $clientContact->first_name }} {{ $clientContact->last_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="cols-3">
                        <x-input type="datetime-local" id="call-date" model="call_date" label="Call date" />
                    </div>
                    <div class="cols-12">
                        <x-cke id="notes" model="notes" label="Instructions"></x-cke>
                    </div>
                </div>
            </div>
            <div class="card-footer flex justify-between">
                <div>

                </div>
                <x-submit id="client-call-created" />
            </div>
        </div>
    </form>
    @assets
    <script src="{{ asset('build/assets/libs/ckeditor/ckeditor.js') }}"></script>
    @endassets
    @script
    <script>
        let eEditor;
        const clientCallEditor = await CKSource.Editor
            .create( document.querySelector( '#notes' ), {
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

        $wire.on('client-call-created', () => {
            eEditor.setData('')
        })
    </script>
    @endscript
</div>
