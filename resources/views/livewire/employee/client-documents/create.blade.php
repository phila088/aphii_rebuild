<?php

use App\Models\Client;
use Livewire\Volt\Component;

new class extends Component {
    public Client $client;
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>
                Create a document
            </h2>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-blue btn-sm" data-hs-overlay="#upload-document-modal">
                Upload document <i class="fe fe-upload"></i>
            </button>
        </div>
    </div>
    <div id="upload-document-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none [--tab-accessibility-limited:true] [--overlay-backdrop:static]" data-hs-overlay-keyboard="false">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all w-3/4 m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Upload document
                    </h3>
                    <button type="button" id="document-upload-modal-closed" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#upload-document-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <livewire:employee.documents.document-upload-modal :client="$client"/>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            HSOverlay.autoInit()
            const el = HSOverlay.getInstance('#upload-document-modal')
            Livewire.on('document-upload-completed', (documentId) => {
                HSOverlay.close('#upload-document-modal');

                @this.set('document_id', documentId.documentId)
            })

            document.querySelector('#document-upload-modal-closed').addEventListener('click', () => {
                Livewire.dispatch('document-upload-canceled');
            })
        })
    </script>
    @endscript
</div>
