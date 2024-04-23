<?php

use App\Models\Client;
use App\Models\DocumentCategory;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Client $client;

    public array $documentCategories;
    public string $mime;
    public string $iconPath;

    public $uploading = false;
    public $progress = 0;

    #[Validate('required|string|exists:document_categories,id')]
    public string $document_category_id = '';
    #[Validate('required|string')]
    public string $title = '';
    #[Validate('nullable|string')]
    public string $description = '';
    #[Validate('nullable|file|max:25600')]
    public $file;

    public function mount(): void
    {
        $this->getDocumentCategories();
        dump($this->uploading, $this->progress);
    }

    public function getDocumentCategories(): void
    {
        $nodes = DocumentCategory::orderBy('_lft')->get()->toTree();
        $documentCategories = [];
        $traverse = function ($categories, $prefix = '') use (&$traverse, &$documentCategories) {
            foreach($categories as $category) {
                $documentCategories[$category->id] = $prefix . ' ' . $category->name;

                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($nodes);

        $this->documentCategories = $documentCategories;
    }

    public function store(): void
    {
        $this->authorize('documents.create');

        $validated = $this->validate();

        if (!empty($this->client)) {
            $validated['client_id'] = $this->client->id;
        }

        if ($document = auth()->user()->document()->create($validated)) {
            if (!empty($this->file)) {
                $baseDir = config('aphii.baseDocumentDir');

                $categoryPath = strtolower($this->buildPath($this->document_category_id));

                $path = $baseDir . '/' . $categoryPath;

                $file = $this->file->store(path: $path);

                $type = $this->file->extension();
                $size = $this->file->getSize();
                $path = $file;
                $path = 'storage' . str_replace('public', '', $path);
                $document->forceFill([
                    'type' => $type,
                    'size' => $size,
                    'path' => $path
                ])->save();
            }

            $this->dispatch('document-upload-completed', documentId: $document->id);
        }
    }

    public function buildPath(int $categoryId): string
    {
        $node = DocumentCategory::find($categoryId);

        $path = $node->name;

        if (!$node->isRoot()) {
            $ancestors = $node->ancestors()->pluck('id')->reverse();

            foreach ($ancestors as $k => $v) {
                $tmpNode = DocumentCategory::find($ancestors[$k]);
                $path = $tmpNode->name . '/' . $path;
            }
        }

        return $path;
    }
}; ?>

<div>
    <form wire:submit="store" novalidate autocomplete="off">
        <div class=""
             x-data="{
                uploading: $wire.entangle('uploading').live,
                progress: $wire.entangle('progress').live,
                name: '',
                type: '', size: 0 }"
             x-on:livewire-upload-start="uploading = true"
             x-on:livewire-upload-finish="uploading = true"
             x-on:livewire-upload-cancel="uploading = false"
             x-on:livewire-upload-error="uploading = false"
             x-on:livewire-upload-progress="progress = $event.detail.progress"
        >
            <div class="form-grid">
                <div class="cols-3">
                    <label for="document-categories-id" class="input-label">Category</label>
                    <select id="document-categories-id" wire:model.live="document_category_id" class="input">
                        <option></option>
                        @foreach ($documentCategories as $id => $documentCategory)
                            <option value="{{ $id }}">{{ $documentCategory }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('document_category')" class="text-xs text-red-500 mt-2"/>
                </div>
                <div class="cols-3">
                    <x-input id="title" model="title" label="Title" />
                </div>
                <div class="cols-6">
                    <x-input id="description" model="description" label="Description" />
                </div>
                <div class="cols-3">
                    <label for="file" class="input-label">Choose file</label>
                    <input type="file" id="file" class="block w-full border border-gray-200 rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                        file:bg-gray-50 file:border-0
                        file:me-4
                        file:py-2 file:px-4
                        dark:file:bg-neutral-700 dark:file:text-neutral-400"
                           wire:model.live="file"
                           x-ref="file"
                           x-on:change='
                            name = $el.files[0].name
                            let longType = $el.files[0].type
                            size = $el.files[0].size
                            console.log(uploading, progress)
                            switch (longType) {
                                case "text/csv":
                                    type = "csv"
                                    break;
                                case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                                    type = "excel"
                                    break;
                                case "application/pdf":
                                    type = "pdf"
                                    break;
                                default:
                                    type = ""
                                    break;
                            }
                        '
                    >
                    <x-input-error :messages="$errors->get('file')" class="text-xs text-red-500 mt-2"/>
                </div>
                <div class="cols-6">
                    <!-- File Uploading Progress Form -->
                    <div x-cloak x-show="uploading">
                        <!-- Uploading File Content -->
                        <div class="mb-2 flex justify-between items-center">
                            <div class="flex items-center gap-x-3">
                                    <span class="size-8 flex justify-center items-center border border-gray-200 text-gray-500 rounded-lg dark:border-neutral-700 dark:text-neutral-500">
                                        <div x-show="type === ''">
                                            <img src="{{ asset('build/assets/img/media/document-icon.svg') }}" alt="File type icon" />
                                        </div>
                                        <div x-show="type === 'csv'">
                                            <img src="{{ asset('build/assets/img/media/csv-icon.svg') }}" alt="File type icon" />
                                        </div>
                                        <div x-show="type === 'excel'">
                                            <img src="{{ asset('build/assets/img/media/excel-icon.svg') }}" alt="File type icon" />
                                        </div>
                                        <div x-show="type === 'pdf'">
                                            <img src="{{ asset('build/assets/img/media/pdf-icon.png') }}" alt="File type icon" />
                                        </div>
                                    </span>
                                <div>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white" id="filename" x-text="name"></p>
                                    <p class="text-xs text-gray-500 dark:text-neutral-500" x-text="Math.round(size / 10240) / 100 + ' MB'"></p>
                                </div>
                            </div>
                            <div class="inline-flex items-center gap-x-2">
                                <div x-show="progress < 100">
                                    <a class="text-gray-500 hover:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200" href="#" wire:click="$cancelUpload('file')">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"></path>
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                            <line x1="10" x2="10" y1="11" y2="17"></line>
                                            <line x1="14" x2="14" y1="11" y2="17"></line>
                                        </svg>
                                    </a>
                                </div>
                                <div x-show="progress === 100">
                                    <a class="text-gray-500 hover:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200" href="#" x-on:click='
                                        $refs.file.value = ""
                                        uploading = false
                                        progress = 0
                                        name = ""
                                        type = ""
                                        size = 0
                                    '>
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"></path>
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                            <line x1="10" x2="10" y1="11" y2="17"></line>
                                            <line x1="14" x2="14" y1="11" y2="17"></line>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- End Uploading File Content -->

                        <!-- Progress Bar -->
                        <div class="flex items-center gap-x-3 whitespace-nowrap">
                            <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">
                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500" x-bind:style="{width: progress + '%'}"></div>
                            </div>
                            <div class="w-6 text-end">
                                <span class="text-sm text-gray-800 dark:text-white" x-text="progress + '%'"></span>
                            </div>
                        </div>
                        <!-- End Progress Bar -->
                    </div>
                    <!-- End File Uploading Progress Form -->
                </div>
            </div>
            <div class="card-footer flex justify-end">
                <button type="submit" class="btn-green btn-sm mx-0.5 rounded disabled:bg-green-200 hover:disabled:bg-green-200" id="document-create" x-bind:disabled=" progress < 100" >
                    Save <i class="fe fe-save"></i>
                </button>
            </div>
        </div>
    </form>
    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            let fileInput = $wire.el.querySelector('input[type="file"]');

            Livewire.on('document-upload-canceled', () => {
                fileInput.value = ""
                $wire.progress = 0
                $wire.uploading = false
            })
        })
    </script>
    @endscript
</div>
