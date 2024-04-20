<?php

use App\Models\Client;
use Livewire\Volt\Component;

new class extends Component
{

    public Client $client;

}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>
                All contacts
            </h2>
        </div>
        <div class="card-body">
            <livewire:ClientContactTable :client="$client" />
        </div>
    </div>
</div>
