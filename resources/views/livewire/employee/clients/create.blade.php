<?php

use App\Models\StatusCode;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
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

        if ($client = auth()->user()->client()->create($validated)) {

            $client->setStatus($this->status_code, $this->status_reason);

            $this->name = '';
            $this->dba = '';
            $this->abbreviation = '';

            request()->session()->flash('toast', 'Client successfully created!');
            request()->session()->flash('toast_type', 'success');

            return redirect()->route('employee.clients.edit', [$client]);
        }
    }

} ?>

<div>
    <form wire:submit="store" novalidate autocomplete="off">
        <div class="card custom-card">
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
