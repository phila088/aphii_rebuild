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
    #[Validate('required|string|email:rfc,dns,spoof,filter')]
    public string $email = '';

    public function mount(): void
    {

    }

    public function store(): void
    {
        $this->authorize('company-emails.create');

        $this->company_id = $this->company->id;

        $validated = $this->validate();

        if ($companyEmail = auth()->user()->companyEmail()->create($validated)) {
            $this->dispatch('company-email-created');

            $this->title = '';
            $this->email = '';
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
                        <x-input id="email" model="email" label="Email" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="company-email-create" />
            </div>
        </div>
    </form>
</div>
