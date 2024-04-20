<?php

use App\Models\Client;
use App\Models\ContactPosition;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component
{
    public Client $client;

    public Collection $positions;

    #[Validate('required|string|min:2|max:50')]
    public string $position = '';
    #[Validate('required|string|min:2|max:50')]
    public string $first_name = '';
    #[Validate('required|string|min:2|max:50')]
    public string $last_name = '';
    #[Validate('nullable|string|min:2|max:50|email:rfc,spoof,filter,dns')]
    public string $email = '';
    #[Validate('nullable|string|min:2|max:50|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public string $phone = '';
    #[Validate('nullable|integer')]
    public string $phone_extension = '';

    public function mount(): void
    {
        $this->getPositions();
    }

    public function store(): void
    {
        $this->authorize('clientContacts.create');

        $validated = $this->validate();

        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        $validated['client_id'] = $this->client->id;

        if ($clientContact = auth()->user()->clientContacts()->create($validated)) {
            $this->dispatch('client-contact-created');

            if (ContactPosition::where('name', $this->position)->get()->isEmpty()) {
                ContactPosition::create(['name' => $this->position]);
            }

            $this->position = '';
            $this->first_name = '';
            $this->last_name = '';
            $this->email = '';
            $this->phone = '';
            $this->phone_extension = '';
        }
    }

    public function getPositions(string $partial = null): void
    {
        if (empty($partial)) {
            $this->positions = ContactPosition::limit(25)
                ->get();
        } else {
            $this->positions = ContactPosition::limit(25)
                ->where('name', 'like', '%' . $partial . '%')
                ->get();
        }
    }
}; ?>

<div>
    <form wire:submit="store" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    Create a contact
                </h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="cols-3">
                        <x-input id="position" model="position" label="Contact position" x-on:input="$wire.getPositions($el.value)" list="positions" />
                        <datalist id="positions">
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->name }}">{{ $pos->name }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="cols-3">
                        <x-input id="first-name" model="first_name" label="First name" />
                    </div>
                    <div class="cols-3">
                        <x-input id="last-name" model="last_name" label="Last name" />
                    </div>
                    <div class="cols-3">
                        <x-input type="email" id="email" model="email" label="Email" />
                    </div>
                    <div class="cols-3">
                        <x-input type="tel" id="phone" model="phone" label="Phone number" x-mask="999-999-9999" />
                    </div>
                    <div class="cols-2">
                        <x-input id="phone-extension" model="phone_extension" label="Extension" x-mask="999999" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="client-contact-create" />
            </div>
        </div>
    </form>
</div>
