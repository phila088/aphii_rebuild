<?php

use App\Models\Company;
use Livewire\Volt\Component;

new class extends Component
{
    public Company $company;

}; ?>

<div>
    <div class="card custom-card">
        <div class="card-body">
            <livewire:CompanyEmailTable :company="$company" />
        </div>
    </div>
</div>
