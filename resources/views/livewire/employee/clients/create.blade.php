<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    #[Validate('required|string|min:2|max:50|unique:clients,name,NULL,NULL,name,NULL')]
    public string $name = '';
    #[Validate('nullable|string|min:2|max:50')]
    public string $dba = '';
    #[Validate('required|string|min:2|max:10|unique:clients,abbreviation,NULL,NULL,abbreviation,NULL')]
    public string $abbreviation = '';

    public function store()
    {
        $this->authorize('clients.create');

        $validated = $this->validate();

        if ($client = auth()->user()->client()->create($validated)) {

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
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-body">
                <div class="form-grid">
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
