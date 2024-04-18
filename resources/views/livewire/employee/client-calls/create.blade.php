<?php

use App\Models\Client;
use App\Models\ClientContact;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component
{
    public Collection $clients;
    public Collection $clientContacts;

    public function mount(): void
    {
        $this->getClients();
        $this->getClientContacts();
    }

    public function getClients(): void
    {
        $this->clients = Client::all();
    }

    public function getClientContacts($clientId = null): void
    {
        if (is_null($clientId) || empty($clientId)) {
            $this->clientContacts = ClientContact::all();
        } else {
            $this->clientContacts = ClientContact::where('client_id', $clientId)
                ->get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>
                Create a call
            </h2>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="cols-3">
                    <label for="client-id" class="input-label">Client</label>
                    <select id="client-id" wire:model="client_id" class="input" x-on:change="$wire.getClientContacts($el.value)">
                        <option></option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
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
            </div>
        </div>
    </div>
</div>
