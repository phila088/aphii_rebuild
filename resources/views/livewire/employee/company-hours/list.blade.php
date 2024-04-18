<?php

use App\Models\Company;
use App\Models\CompanyHour;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component
{
    public Company $company;
    public ?CompanyHour $companyHour = null;
    public ?int $id = null;

    public function mount(): void
    {

    }

    #[On('company-hours-edit')]
    public function getModel(): void
    {
        $this->companyHour = CompanyHour::find($this->id);
    }

    #[On('company-hours-updated')]
    #[On('company-hours-edit-canceled')]
    public function cancel(): void
    {
        $this->companyHour = null;
    }
} ?>

<div>
    <div class="card custom-card">
        <div class="card-body">
            <livewire:CompanyHourTable :company="$company" />
        </div>
    </div>
    @if (!is_null($companyHour))
        <div wire:transition>
            <livewire:employee.company-hours.edit :companyHour="$companyHour" />
        </div>
    @endif
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('company-hours-edit', (rowId) => {
                @this.set('id', rowId[0])
            })
        })
    </script>
</div>
