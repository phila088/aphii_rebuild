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
            </div>
            <div class="card-footer">
                <x-submit id="client-contract-create" />
            </div>
        </div>
    </form>
</div>
