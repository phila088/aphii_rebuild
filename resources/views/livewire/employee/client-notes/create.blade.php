<?php

use App\Models\Client;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component
{
    public Client $client;

    #[Validate('required|string')]
    public string $note = '';

    public function store(): void
    {
        $this->authorize('clientNotes.create');

        $validated = $this->validate();

        $validated['client_id'] = $this->client->id;

        if ($clientNote = auth()->user()->clientNotes()->create($validated)) {
            $this->dispatch('client-note-created');

            $this->note = '';
        }
    }
}; ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    Create a note
                </h2>
            </div>
            <div class="card-body">
                <x-cke id="client-notes" model="note" label="Notes"></x-cke>
            </div>
            <div class="card-footer">
                <x-submit id="client-note-create" />
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
            .create( document.querySelector( '#client-notes' ), {
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
            eEditor.setData('{{ $note }}')
        })

        function saveData(data, editor) {
            return new Promise(resolve => {
                setTimeout(() => {

                    $wire.note = data

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

        $wire.on('client-note-created', () => {
            eEditor.setData('')
        })
    </script>
    @endscript
</div>
