<?php

namespace App\Livewire;

use App\Models\CompanyAddress;
use LivewireUI\Modal\ModalComponent;

class DeleteCompanyAddress extends ModalComponent
{
    public CompanyAddress $companyAddress;

    public function mount(): void
    {
        $this->authorize('company-address-delete');
    }

    public function render()
    {
        return view('livewire.employee.company-addresses.delete');
    }

    public function confirmDelete(): void
    {
        $this->companyAddress->delete($this->companyAddress->id);
    }
}
