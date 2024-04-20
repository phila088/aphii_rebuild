<?php

use App\Models\Company;
use Illuminate\Support\Carbon;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    public Company $company;

    public string $monday_copy_to = '';
    public string $tuesday_copy_to = '';
    public string $wednesday_copy_to = '';
    public string $thursday_copy_to = '';
    public string $friday_copy_to = '';
    public string $saturday_copy_to = '';
    public string $sunday_copy_to = '';

    public array $timezones;

    #[Validate('required|int')]
    public int $company_id;
    #[Validate('required|string|min:2|max:50')]
    public string $title = '';
    #[Validate('required|string')]
    public string $timezone = '';
    #[Validate('nullable|string|')]
    public ?string $monday_open = '';
    #[Validate('nullable|string|')]
    public ?string $monday_close = '';
    #[Validate('nullable|string|')]
    public ?string $tuesday_open = '';
    #[Validate('nullable|string|')]
    public ?string $tuesday_close = '';
    #[Validate('nullable|string|')]
    public ?string $wednesday_open = '';
    #[Validate('nullable|string|')]
    public ?string $wednesday_close = '';
    #[Validate('nullable|string|')]
    public ?string $thursday_open = '';
    #[Validate('nullable|string|')]
    public ?string $thursday_close = '';
    #[Validate('nullable|string|')]
    public ?string $friday_open = '';
    #[Validate('nullable|string|')]
    public ?string $friday_close = '';
    #[Validate('nullable|string|')]
    public ?string $saturday_open = '';
    #[Validate('nullable|string|')]
    public ?string $saturday_close = '';
    #[Validate('nullable|string|')]
    public ?string $sunday_open = '';
    #[Validate('nullable|string|')]
    public ?string $sunday_close = '';

    public function mount(): void
    {
        $this->company_id = $this->company->id;
        $this->timezones = (__('selects.timezones'));
        $this->timezone = auth()->user()->userProfile->timezone;
    }

    public function store(): void
    {
        $this->authorize('company-hours.create');

        $days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ];

        foreach ($days as $day) {
            if ($this->{$day . '_open'} === '') {
                $this->{$day . '_open'} = null;
            }
            if ($this->{$day . '_close'} === '') {
                $this->{$day . '_close'} = null;
            }
        }

        if ($this->timezone !== config('app.timezone')) {
            foreach ($days as $day) {
                if (!is_null($this->{$day . '_open'})) {
                    $this->{$day . '_open'} = Carbon::parse($this->{$day . '_open'} . ' ' . $this->timezone)->setTimezone(config('app.timezone'))->format('H:i:s');
                }
                if (!is_null($this->{$day . '_close'})) {
                    $this->{$day . '_close'} = Carbon::parse($this->{$day . '_close'} . ' ' . $this->timezone)->setTimezone(config('app.timezone'))->format('H:i:s');
                }
            }
        }

        $validated = $this->validate();

        $regexArr = [];

        foreach ($days as $day) {
            $regexArr[$day . '_open'] = ['nullable', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/i'];
            $regexArr[$day . '_close'] = ['nullable', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/i'];
        }

        $regex = $this->validate($regexArr);

        $validated = array_merge($validated, $regex);

        if (auth()->user()->companyHours()->create($validated)) {
            $this->dispatch('company-hours-created');

            $this->title = '';
            $this->monday_open = '';
            $this->monday_close = '';
            $this->tuesday_open = '';
            $this->tuesday_close = '';
            $this->wednesday_open = '';
            $this->wednesday_close = '';
            $this->thursday_open = '';
            $this->thursday_close = '';
            $this->friday_open = '';
            $this->friday_close = '';
            $this->saturday_open = '';
            $this->saturday_close = '';
            $this->sunday_open = '';
            $this->sunday_close = '';
        }
    }

    public function copyTo(string $from, string $to): void
    {
        $this->monday_copy_to = '';
        $this->tuesday_copy_to = '';
        $this->wednesday_copy_to = '';
        $this->thursday_copy_to = '';
        $this->friday_copy_to = '';
        $this->saturday_copy_to = '';
        $this->sunday_copy_to = '';

        switch ($to) {
            case 'monday':
                $this->monday_open = $this->{$from.'_open'};
                $this->monday_close = $this->{$from.'_close'};
                break;
            case 'tuesday':
                $this->tuesday_open = $this->{$from.'_open'};
                $this->tuesday_close = $this->{$from.'_close'};
                break;
            case 'wednesday':
                $this->wednesday_open = $this->{$from.'_open'};
                $this->wednesday_close = $this->{$from.'_close'};
                break;
            case 'thursday':
                $this->thursday_open = $this->{$from.'_open'};
                $this->thursday_close = $this->{$from.'_close'};
                break;
            case 'friday':
                $this->friday_open = $this->{$from.'_open'};
                $this->friday_close = $this->{$from.'_close'};
                break;
            case 'saturday':
                $this->saturday_open = $this->{$from.'_open'};
                $this->saturday_close = $this->{$from.'_close'};
                break;
            case 'sunday':
                $this->sunday_open = $this->{$from.'_open'};
                $this->sunday_close = $this->{$from.'_close'};
                break;
            case 'weekdays':
                $this->monday_open = $this->{$from.'_open'};
                $this->monday_close = $this->{$from.'_close'};
                $this->tuesday_open = $this->{$from.'_open'};
                $this->tuesday_close = $this->{$from.'_close'};
                $this->wednesday_open = $this->{$from.'_open'};
                $this->wednesday_close = $this->{$from.'_close'};
                $this->thursday_open = $this->{$from.'_open'};
                $this->thursday_close = $this->{$from.'_close'};
                $this->friday_open = $this->{$from.'_open'};
                $this->friday_close = $this->{$from.'_close'};
                break;
            case 'weekends':
                $this->saturday_open = $this->{$from.'_open'};
                $this->saturday_close = $this->{$from.'_close'};
                $this->sunday_open = $this->{$from.'_open'};
                $this->sunday_close = $this->{$from.'_close'};
                break;
        }
    }
} ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>
                    Create hours
                </h2>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-7">
                    <div class="cols-12 form-grid">
                        <div class="cols-3">
                            <x-input id="title" model="title" label="Title" />
                        </div>
                        <div class="cols-3">
                            <label for="timezone" class="input-label">Timezone</label>
                            <select id="timezone" wire:model="timezone" class="input">
                                <option></option>
                                @foreach ($timezones as $timezone)
                                    <option value="{{ $timezone }}">{{ $timezone }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="cols-1">
                        <div class="cols-7 text-center">Monday</div>
                        <div class="cols-7">
                            <label for="monday-copy-to" class="input-label">Copy to</label>
                            <select id="monday-copy-to" wire:model="monday_copy_to" class="input" x-on:change="$wire.copyTo('monday', $el.value)">
                                <option></option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                                <option value="weekdays">Weekdays</option>
                                <option value="weekends">Weekends</option>
                            </select>
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="monday-open" model="monday_open" />
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="monday-close" model="monday_close" />
                        </div>
                    </div>
                    <div class="cols-1">
                        <div class="cols-7 text-center">Tuesday</div>
                        <div class="cols-7">
                            <label for="tuesday-copy-to" class="input-label">Copy to</label>
                            <select id="tuesday-copy-to" wire:model="tuesday_copy_to" class="input" x-on:change="$wire.copyTo('tuesday', $el.value)">
                                <option></option>
                                <option value="monday">Monday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                                <option value="weekdays">Weekdays</option>
                                <option value="weekends">Weekends</option>
                            </select>
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="tuesday-open" model="tuesday_open" />
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="tuesday-close" model="tuesday_close" />
                        </div>
                    </div>
                    <div class="cols-1">
                        <div class="cols-7 text-center">Wednesday</div>
                        <div class="cols-7">
                            <label for="wednesday-copy-to" class="input-label">Copy to</label>
                            <select id="wednesday-copy-to" wire:model="wednesday_copy_to" class="input" x-on:change="$wire.copyTo('wednesday', $el.value)">
                                <option></option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                                <option value="weekdays">Weekdays</option>
                                <option value="weekends">Weekends</option>
                            </select>
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="wednesday-open" model="wednesday_open" />
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="wednesday-close" model="wednesday_close" />
                        </div>
                    </div>
                    <div class="cols-1">
                        <div class="cols-7 text-center">Thursday</div>
                        <div class="cols-7">
                            <label for="thursday-copy-to" class="input-label">Copy to</label>
                            <select id="thursday-copy-to" wire:model="thursday_copy_to" class="input" x-on:change="$wire.copyTo('thursday', $el.value)">
                                <option></option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                                <option value="weekdays">Weekdays</option>
                                <option value="weekends">Weekends</option>
                            </select>
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="thursday-open" model="thursday_open" />
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="thursday-close" model="thursday_close" />
                        </div>
                    </div>
                    <div class="cols-1">
                        <div class="cols-7 text-center">Friday</div>
                        <div class="cols-7">
                            <label for="friday-copy-to" class="input-label">Copy to</label>
                            <select id="friday-copy-to" wire:model="friday_copy_to" class="input" x-on:change="$wire.copyTo('friday', $el.value)">
                                <option></option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                                <option value="weekdays">Weekdays</option>
                                <option value="weekends">Weekends</option>
                            </select>
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="friday-open" model="friday_open" />
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="friday-close" model="friday_close" />
                        </div>
                    </div>
                    <div class="cols-1">
                        <div class="cols-7 text-center">Saturday</div>
                        <div class="cols-7">
                            <label for="saturday-copy-to" class="input-label">Copy to</label>
                            <select id="saturday-copy-to" wire:model="saturday_copy_to" class="input" x-on:change="$wire.copyTo('saturday', $el.value)">
                                <option></option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="sunday">Sunday</option>
                                <option value="weekdays">Weekdays</option>
                                <option value="weekends">Weekends</option>
                            </select>
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="saturday-open" model="saturday_open" />
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="saturday-close" model="saturday_close" />
                        </div>
                    </div>
                    <div class="cols-1">
                        <div class="cols-7 text-center">Sunday</div>
                        <div class="cols-7">
                            <label for="sunday-copy-to" class="input-label">Copy to</label>
                            <select id="sunday-copy-to" wire:model="sunday_copy_to" class="input" x-on:change="$wire.copyTo('sunday', $el.value)">
                                <option></option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="weekdays">Weekdays</option>
                                <option value="weekends">Weekends</option>
                            </select>
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="sunday-open" model="sunday_open" />
                        </div>
                        <div class="cols-7">
                            <x-input type="time" id="sunday-close" model="sunday_close" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="company-hours-create" />
            </div>
        </div>
    </form>
</div>
