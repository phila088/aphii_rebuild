<?php

use App\Models\Company;
use App\Models\CompanyAddress;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public Company $company;
    public ?CompanyAddress $companyAddress = null;
    public ?int $id = null;

    public function mount(): void
    {

    }

    #[On('company-address-edit')]
    public function getModel(): void
    {
        $this->companyAddress = CompanyAddress::find($this->id);
    }

    #[On('company-address-updated')]
    #[On('company-address-edit-canceled')]
    public function cancel()
    {
        $this->companyAddress = null;
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>All addresses</h2>
        </div>
        <div class="card-body">
            <livewire:CompanyAddressTable :company="$company"/>
        </div>
    </div>
    @if (!is_null($companyAddress))
        <div wire:transition>
            <livewire:employee.company-addresses.edit :companyAddress="$companyAddress" />
        </div>
    @endif
    @section ('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('company-address-edit', (rowId) => {
                    @this.set('id', rowId)
                })
            })
        </script>
    @endsection
</div>
