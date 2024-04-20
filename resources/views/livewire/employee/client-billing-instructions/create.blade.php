<?php

use App\Models\Client;
use App\Models\ClientBillingInstruction;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Client $client;
    public ?ClientBillingInstruction $clientBillingInstructions = null;

    #[Validate('required|integer')]
    public int $client_id;
    #[Validate('nullable|string')]
    public string $instructions = '';

    public function mount(): void
    {
        $this->getClientBillingInstructions();

        $this->client_id = $this->client->id;
    }

    #[On('client-client-billing-instructions-created')]
    #[On('client-client-billing-instructions-updated')]
    public function getClientBillingInstructions(): void
    {
        $clientBillingInstructions = ClientBillingInstruction::where('client_id', $this->client->id)
            ->limit(1)
            ->get();

        if (!$clientBillingInstructions->isEmpty()) {
            $this->clientBillingInstructions = $clientBillingInstructions[0];
            $this->instructions = $clientBillingInstructions[0]->instructions;
        } else {
            $this->clientBillingInstructions = null;
        }
    }

    public function store(): void
    {
        $validated = $this->validate();

        if (is_null($this->clientBillingInstructions)){
            if (auth()->user()->clientBillingInstructions()->create($validated)) {
                $this->dispatch('client-client-billing-instructions-created');
            }
        } else {
            if ($this->clientBillingInstructions->update($validated)) {
                $this->dispatch('client-client-billing-instructions-updated');
            }
        }

    }
}; ?>

<div>
    @assets
        <link rel="stylesheet" href="{{ asset('build/assets/libs/ckeditor/default.css') }}">
    @endassets
    <div class="card custom-card">
        <div class="card-header">
            <h2>
                Create billing instructions
            </h2>
        </div>
        <div class="card-body">
            <x-cke id="instructions" model="instructions" label="Instructions">{{ $instructions }}</x-cke>
        </div>
    </div>
    @assets
    <script src="{{ asset('build/assets/libs/ckeditor/ckeditor.js') }}"></script>
    @endassets
    @script
    <script>
        let eEditor;
        const clientBillingInstructionsEditor = await CKSource.Editor
            .create( document.querySelector( '#instructions' ), {
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
            .catch( handleClientBillingInstructionsError );

        function handleClientBillingInstructionsError( error ) {
            const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

            const message = [
                'Oops, something went wrong!',
                `Please, report the following error on ${ issueUrl } with the build id "y3r0qxylsb8q-2mlzsm176itn" and the error stack trace:`
            ].join( '\n' );

            console.error( message );
            console.error( error );
        }

        document.addEventListener('load', () => {
            eEditor.setData('{{ $instructions }}')
        })

        function saveData(data, editor) {
            return new Promise(resolve => {
                setTimeout(() => {

                    $wire.instructions = data

                    $wire.store()

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
    </script>
    @endscript
</div>
