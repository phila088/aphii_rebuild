<?php

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Livewire\Volt\Component;

new class extends Component
{
    public Client $client;
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>
                All contracts
            </h2>
        </div>
        <div class="card-body">
            <livewire:client-contract-table :client="$client" />
        </div>
    </div>
</div>
