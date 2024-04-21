<?php

use App\Models\CompanyAddress;
use App\Models\States;
use App\Models\City;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public $company;
    public bool $physicalExists = false;
    public bool $remittanceExists = false;
    public $directions = [];
    public $street_types = [];
    public $unit_types = [];
    public $cities = null;
    public ?Collection $states = null;

    #[Validate('required|int')]
    public int $company_id;
    #[Validate('required|string|min:2|max:50')]
    public string $title;
    #[Validate('required_without:po_box|string|min:1|max:10')]
    public string $building_number;
    #[Validate('nullable|string')]
    public string $pre_direction;
    #[Validate('nullable|string|min:2|max:50')]
    public string $street_name;
    #[Validate('nullable|required_with:street_name|string')]
    public string $street_type;
    #[Validate('nullable|string')]
    public string $post_direction;
    #[Validate('nullable|string')]
    public string $unit;
    #[Validate('nullable|required_with:unit|string')]
    public string $unit_type;
    #[Validate('nullable|required_without:building_number|string')]
    public string $po_box;
    #[Validate('required|string')]
    public string $city;
    #[Validate('required|string')]
    public string $state;
    #[Validate('required|string')]
    public string $zip;

    public function mount(): void
    {
        $this->directions = (__('selects.cardinal-directions'));
        $this->street_types = (__('selects.street-types'));
        $this->unit_types = (__('selects.unit-types'));
        $this->states = States::get();
        $this->company_id = $this->company->id;
    }

    public function store()
    {
        $validated = $this->validate();

        if (auth()->user()->companyAddress()->create($validated))
        {
            $this->dispatch('company-address-created', data: $this->title);

            $this->title = '';
            $this->building_number = '';
            $this->pre_direction = '';
            $this->street_name = '';
            $this->street_type = '';
            $this->post_direction = '';
            $this->unit = '';
            $this->unit_type = '';
            $this->po_box = '';
            $this->city = '';
            $this->state = '';
            $this->zip = '';
        }
    }

    public function cityLookupByName(string $name = null)
    {
        $cities = City::where('name', 'like', '%'.$name.'%')
            ->orderBy('name')
            ->limit(250)
            ->with('state')
            ->get();

        $city = [];

        foreach ($cities as $k => $v)
        {
            $city[] = [
                'city' => $cities[$k]->name,
                'state' => $cities[$k]->state->code,
                'zip' => $cities[$k]->zip
            ];
        }
        $this->cities = $city;
    }

    public function cityLookupByZip(string $zip)
    {
        $cities = City::where('zip', 'like', '%'.$zip.'%')
            ->orderBy('name')
            ->limit(250)
            ->with('state')
            ->get();

        $city = [];

        foreach ($cities as $k => $v)
        {
            $city[] = [
                'city' => $cities[$k]->name,
                'state' => $cities[$k]->state->code,
                'zip' => $cities[$k]->zip
            ];
        }
        $this->cities = $city;
    }
}; ?>

<div>
    <form wire:submit="store" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                Create an address
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="cols-3">
                        <x-input id="title" model="title" label="Title" />
                    </div>
                </div>
                <div class="form-grid mt-3">
                    <div class="cols-2">
                        <x-input id="build-number" model="building_number" label="Building number" />
                    </div>
                    <div class="cols-2">
                        <label for="pre-direction" class="input-label">Pre direction</label>
                        <select id="pre-direction" wire:model.live="pre_direction" class="input">
                            <option></option>
                            @foreach ($directions as $key => $direction)
                                <option value="{{ $key }}">{{ $key }} - {{ $direction }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-4">
                        <x-input id="street-name" model="street_name" label="Street name" />
                    </div>
                    <div class="cols-2">
                        <label for="street-type" class="input-label">Street type</label>
                        <select id="street_type" wire:model.live="street_type" class="input">
                            <option></option>
                            @foreach ($street_types as $key => $streetType)
                                <option value="{{ $key }}">{{ $key }} - {{ $streetType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-2">
                        <label for="post-direction" class="input-label">Post direction</label>
                        <select id="post-direction" wire:model.live="post_direction" class="input">
                            <option></option>
                            @foreach ($directions as $key => $direction)
                                <option value="{{ $key }}">{{ $key }} - {{ $direction }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-grid mt-3">
                    <div class="cols-2">
                        <label for="unit-type" class="input-label">Unit type</label>
                        <select id="unit-type" wire:model.live="unit_type" class="input">
                            <option></option>
                            @foreach ($unit_types as $key => $unitType)
                                <option value="{{ $unitType }}">{{ $key }} - {{ $unitType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-2">
                        <x-input id="unit" model="unit" label="Unit" />
                    </div>
                    <div class="cols-2">
                        <x-input id="po-box" model="po_box" label="PO box" />
                    </div>
                    <div class="cols-2">
                        <label for="city" class="input-label">City</label>
                        <input
                            type="text"
                            id="city"
                            class="input"
                            list="cities"
                            wire:model.live="city"
                            x-on:input="$wire.cityLookupByName($el.value)"
                            x-on:change='
                                const datalist = document.getElementById("cities")
                                const stateEl = document.getElementById("state")
                                const zipEl = document.getElementById("zip")

                                let selOpt = document.querySelector("option[value=\"" + $el.value + "\"]")

                                let key = selOpt.dataset.value

                                let city = $wire.cities[key]["city"]
                                let state = $wire.cities[key]["state"]
                                let zip = $wire.cities[key]["zip"]

                                $wire.city = city
                                $wire.state = state
                                $wire.zip = zip
                            '
                        >
                        <datalist id="cities">
                            @if (!empty($cities))
                                @foreach ($cities as $key => $data)
                                    <option data-value="{{ $key }}" value="{{ $data['city'] }}, {{ $data['state'] }} {{ $data['zip'] }}">{{ $data['city'] }}</option>
                                @endforeach
                            @endif
                        </datalist>
                        <x-input-error :messages="$errors->get('city')" class="tw-text-xs tw-text-red-500 mt-2"/>
                    </div>

                    <!-- Physical address state -->
                    <div class="cols-2">
                        <label for="state" class="input-label">State</label>
                        <select id="state" wire:model="state" class="input">
                            <option></option>
                            @foreach ($states as $state)
                                <option value="{{ $state->code }}">{{ $state->code }} - {{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Physical address zip -->
                    <div class="cols-2">
                        <label for="zip" class="input-label">Zip</label>
                        <input
                            type="text"
                            id="zip"
                            class="input"
                            list="zips"
                            wire:model.live="zip"
                            x-on:input="$wire.cityLookupByZip($el.value)"
                            x-on:change='
                                const datalist = document.getElementById("zips")
                                const cityEl = document.getElementById("city")
                                const stateEl = document.getElementById("state")

                                let selOpt = document.querySelector("option[value=\"" + $el.value + "\"]")

                                let key = selOpt.dataset.value

                                let city = $wire.cities[key]["city"]
                                let state = $wire.cities[key]["state"]
                                let zip = $wire.cities[key]["zip"]

                                $wire.city = city
                                $wire.state = state
                                $wire.zip = zip
                            '
                        >
                        <datalist id="zips">
                            @if (!empty($cities))
                                @foreach ($cities as $key => $data)
                                    <option data-value="{{ $key }}" value="{{ $data['city'] }}, {{ $data['state'] }} {{ $data['zip'] }}">{{ $data['city'] }}</option>
                                @endforeach
                            @endif
                        </datalist>
                        <x-input-error :messages="$errors->get('zip')" class="text-xs text-red-500 mt-2"/>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="company-address-create" />
            </div>
        </div>
    </form>
</div>
