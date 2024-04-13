<?php

use App\Models\Company;
use Livewire\Volt\Component;

new class extends Component {
    public Company $company;
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-body">
            <livewire:CompanyAddressTable :company="$company"/>
        </div>
    </div>
</div>
