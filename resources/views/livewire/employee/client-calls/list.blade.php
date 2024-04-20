<?php

use App\Models\Client;
use App\Models\ClientCall;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Livewire\Volt\Component;

new class extends Component
{
    public Client $client;

    public Collection $clientCalls;

    public function mount(): void
    {
        $this->getClientCalls();
    }

    public function getClientCalls(): void
    {
        $this->clientCalls = ClientCall::latest()
            ->limit(10)
            ->orderBy('call_date', 'asc')
            ->get();
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>
                All calls
            </h2>
        </div>
        <div class="card-body">
            <livewire:ClientCallTable :client="$client" />
        </div>
    </div>
</div>
