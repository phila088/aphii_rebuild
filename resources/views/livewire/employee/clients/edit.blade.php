<?php

use App\Models\Client;
use App\Models\StatusCode;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    public Client $client;
    public Collection $statusCodes;

    #[Validate('required|string|min:2|max:50|unique:clients,name,NULL,NULL,name,NULL')]
    public string $name = '';
    #[Validate('nullable|string|min:2|max:50')]
    public string $dba = '';
    #[Validate('required|string|min:2|max:10|unique:clients,abbreviation,NULL,NULL,abbreviation,NULL')]
    public string $abbreviation = '';
    #[Validate('required|string')]
    public string $status_code = '';
    #[Validate('required|string')]
    public string $status_reason = '';

    public function mount(): void
    {
        $this->getStatusCodes();

        $this->name = $this->client->name;
        $this->dba = $this->client->dba;
        $this->abbreviation = $this->client->abbreviation;

        $latestStatus = $this->client->status();

        $this->status_code = $latestStatus->name;
        $this->status_reason = $latestStatus->reason;
    }

    public function getStatusCodes(): void
    {
        $this->statusCodes = StatusCode::where('for_model', 'Client')
            ->get();
    }

    public function getStatusReason($code): void
    {
        $reason = StatusCode::select('description')
            ->where('for_model', 'Client')
            ->where('code', $code)
            ->get();

        $this->status_reason = $reason = $reason->isNotEmpty() ? $reason->first()->description : '';
    }

    public function store()
    {
        $this->authorize('clients.create');

        $validated = $this->validate();

        if ($this->client->update($validated)) {

            if ($this->status_code !== $this->client->status || $this->status_reason !== $this->client->status()->reason) {
                $this->client->setStatus($this->status_code, $this->status_reason);
            }

            $this->dispatch('client-edited');
        }
    }

} ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    General details
                </h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="cols-3">
                        <label for="status-code" class="input-label">Status</label>
                        <select id="status-code" wire:model="status_code" class="input" x-on:change="$wire.getStatusReason($el.value)">
                            <option></option>
                            @foreach ($statusCodes as $statusCode)
                                <option value="{{ $statusCode->code }}">{{ $statusCode->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-9">
                        <x-input id="status-reason" model="status_reason" label="Status Reason" />
                    </div>
                    <div class="cols-3">
                        <x-input id="name" model="name" label="Name" />
                    </div>
                    <div class="cols-3">
                        <x-input id="dba" model="dba" label="DBA" />
                    </div>
                    <div class="cols-3">
                        <x-input id="abbreviation" model="abbreviation" label="Abbreviation" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="client-create" />
            </div>
        </div>
    </form>
</div>
