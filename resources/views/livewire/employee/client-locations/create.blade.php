<?php

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {
    public Client $client;

    public array $directions;
    public array $streetTypes;
    public array $unitTypes;
    public Collection $cities;
    public Collection $states;

    #[Validate('required|string|min:2|max:50')]
    public string $name = '';
    #[Validate('nullable|string|min:2')]
    public string $description = '';
    #[Validate('required_without:po_box|string')]
    public string $building_number = '';
    #[Validate('nullable|string')]
    public string $pre_direction = '';
    #[Validate('required_without:po_box|string')]
    public string $street_name = '';
    #[Validate('required_without:po_box|string')]
    public string $street_type = '';
    #[Validate('nullable|string')]
    public string $post_direction = '';
    #[Validate('required_with:unit|string')]
    public string $unit_type = '';
    #[Validate('required_with:unit_type|string')]
    public string $unit = '';
    #[Validate('required_without:building_number|string')]
    public string $po_box = '';
    #[Validate('required|string')]
    public string $city = '';
    #[Validate('required|string')]
    public string $state = '';
    #[Validate('required|string')]
    public string $zip = '';
    #[Validate('nullable|string')]
    public string $monday_open = '';
    #[Validate('nullable|string')]
    public string $monday_close = '';
    #[Validate('nullable|string')]
    public string $tuesday_open = '';
    #[Validate('nullable|string')]
    public string $tuesday_close = '';
    #[Validate('nullable|string')]
    public string $wednesday_open = '';
    #[Validate('nullable|string')]
    public string $wednesday_close = '';
    #[Validate('nullable|string')]
    public string $thursday_open = '';
    #[Validate('nullable|string')]
    public string $thursday_close = '';
    #[Validate('nullable|string')]
    public string $friday_open = '';
    #[Validate('nullable|string')]
    public string $friday_close = '';
    #[Validate('nullable|string')]
    public string $saturday_open = '';
    #[Validate('nullable|string')]
    public string $saturday_close = '';
    #[Validate('nullable|string')]
    public string $sunday_open = '';
    #[Validate('nullable|string')]
    public string $sunday_close = '';


    public function mount(): void
    {
        $this->directions = (__('selects.cardinal-directions'));
        $this->streetTypes = (__('selects.street-types'));
        $this->unitTypes = (__('selects.unit-types'));
    }

    public function store(): void
    {
        $this->authorize('clientLocations.create');

        $validated = $this->validate();

        $days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ];

        $regex = [];

        foreach ($days as $day) {
            $regex[$day . '_open'] = ['nullable', 'string', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/i'];
            $regex[$day . '_close'] = ['nullable', 'string', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/i'];
        }

        $regex = $this->validate($regex);

        $validated = array_merge($validated, $regex);

        dd($validated);
    }
}; ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    Create a location
                </h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="cols-3">
                        <x-input id="name" model="name" label="Name" />
                    </div>
                    <div class="cols-9">
                        <x-input id="description" model="description" label="Description" />
                    </div>
                    <div class="cols-2">
                        <x-input id="build-number" model="building_number" label="Building number" />
                    </div>
                    <div class="cols-2">
                        <label for="pre-direction" class="input-label">Pre direction</label>
                        <select id="pre-direction" wire:model="pre_direction" class="input">
                            <option></option>
                            @foreach ($directions as $key => $direction)
                                <option value="{{ $key }}">{{ $key  }} - {{ $direction }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-4">
                        <x-input id="street-name" model="street_name" label="Street name" />
                    </div>
                    <div class="cols-2">
                        <label for="street-type" class="input-label">Street type</label>
                        <select id="street-type" wire:model="street_type" class="input">
                            <option></option>
                            @foreach ($streetTypes as $key => $streetType)
                                <option value="{{ $key }}">{{ $key  }} - {{ $streetType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-2">
                        <label for="post-direction" class="input-label">Post direction</label>
                        <select id="post-direction" wire:model="post_direction" class="input">
                            <option></option>
                            @foreach ($directions as $key => $direction)
                                <option value="{{ $key }}">{{ $key  }} - {{ $direction }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-2">
                        <label for="unit-type" class="input-label">Unit type</label>
                        <select id="unit-type" wire:model="unit_type" class="input">
                            <option></option>
                            @foreach ($unitTypes as $key => $unitType)
                                <option value="{{ $key }}">{{ $key  }} - {{ $unitType }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </form>
</div>
