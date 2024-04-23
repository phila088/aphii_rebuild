<?php

use App\Models\Client;
use App\Models\Company;
use App\Models\DocumentCategory;
use App\Models\PaymentTerm;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;

new class extends Component
{
    use WithFileUploads;

    public Client $client;
    public Collection $companies;
    public Collection $paymentTerms;
    public array $documentCategories;

    #[Validate('required|integer|exists:companies,id')]
    public ?int $company_id = null;
    #[Validate('nullable|string|min:2|max:50')]
    public string $contract_number = '';
    #[Validate('required|date')]
    public string $start_date = '';
    #[Validate('required|date')]
    public string $end_date = '';
    #[Validate('required|integer|exists:payment_terms,id')]
    public ?int $payment_term_id = null;
    #[Validate('required|integer|exists:documents,id', as: 'document')]
    public ?int $document_id = null;

    public function mount(): void
    {
        $this->getCompanies();
        $this->getPaymentTerms();
        $this->getDocumentCategories();
    }

    public function getCompanies(): void
    {
        $this->companies = Company::get();
    }

    public function getPaymentTerms(): void
    {
        $this->paymentTerms = PaymentTerm::get();
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
        $this->authorize('clientContracts.create');

        $validated = $this->validate();

        $validated['client_id'] = $this->client->id;

        if ($clientContract = auth()->user()->clientContracts()->create($validated)) {
            $this->dispatch('client-contract-created');


        }
    }

    private function buildPath(int $categoryId): string
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
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    Create a contract
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
                    <div class="cols-3">
                        <x-input id="contract-number" model="contract_number" label="Contract number" />
                    </div>
                    <div class="cols-2">
                        <x-input type="date" id="start-date" model="start_date" label="Start date" />
                    </div>
                    <div class="cols-2">
                        <x-input type="date" id="end-date" model="end_date" label="End date" />
                    </div>
                    <div class="cols-2">
                        <label for="payment-term-id" class="input-label">Payment terms</label>
                        <select id="payment-term-id" wire:model="payment_term_id" class="input">
                            <option></option>
                            @foreach ($paymentTerms as $paymentTerm)
                                <option value="{{ $paymentTerm->id }}">{{ $paymentTerm->code }} - {{ $paymentTerm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-3"></div>
                </div>
                <button type="button" class="btn btn-blue btn-sm" data-hs-overlay="#upload-contract-modal">
                    Upload contract <i class="fe fe-upload"></i>
                </button>
                <x-input-error :messages="$errors->get('document_id')" class="text-xs text-red-500 mt-2"/>

            </div>
            <div class="card-footer">
                <x-submit id="client-contract-create" />
            </div>
        </div>
    </form>
    <div id="upload-contract-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none [--tab-accessibility-limited:true] [--overlay-backdrop:static]" data-hs-overlay-keyboard="false">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all w-3/4 m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Upload contract
                    </h3>
                    <button type="button" id="document-upload-modal-close" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#upload-contract-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <livewire:employee.documents.create-modal :client="$client"/>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            HSOverlay.autoInit()
            const el = HSOverlay.getInstance('#upload-contract-modal')
            Livewire.on('document-upload-completed', (documentId) => {
                HSOverlay.close('#upload-contract-modal');

                @this.set('document_id', documentId.documentId)
            })

            document.querySelector('#document-upload-modal-close').addEventListener('click', () => {
                console.log('closed')
                $wire.dispatch('document-upload-canceled');
            })
        })
    </script>
    @endscript
</div>
