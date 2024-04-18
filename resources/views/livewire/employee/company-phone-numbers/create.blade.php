<?php

use App\Models\Company;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    public Company $company;

    #[Validate('nullable|int')]
    public int $company_id;
    #[Validate('required|string|min:2|max:50|unique:company_emails,title,NULL,NULL,id,NULL')]
    public string $title = '';
    #[Validate('required|string|regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/i')]
    public string $phone = '';
    #[Validate('nullable|string')]
    public string $extension = '';

    public function mount(): void
    {

    }

    public function store(): void
    {
        $this->authorize('company-phones.create');

        $this->company_id = $this->company->id;

        $validated = $this->validate();

        if ($companyPhone = auth()->user()->companyPhone()->create($validated)) {
            $this->dispatch('company-phone-created');

            $this->title = '';
            $this->phone_number = '';
            $this->phone_number_extension = '';
        }
    }

}; ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    Create an email
                </h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="cols-3">
                        <x-input id="title" model="title" label="Title" />
                    </div>
                    <div class="cols-3">
                        <x-input type="tel" id="phone" model="phone" label="Phone number" x-mask="999-999-9999" />
                    </div>
                    <div class="cols-3">
                        <x-input id="extension" model="extension" label="Extension" x-mask="999999" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="company-email-create" />
            </div>
        </div>
    </form>
</div>
