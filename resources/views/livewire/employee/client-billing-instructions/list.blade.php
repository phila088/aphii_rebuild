<?php

use App\Models\Client;
use App\Models\ClientBillingInstruction;
use Livewire\Volt\Component;

new class extends Component
{
    public Client $client;

    public ?string $instructions;

    public function mount(): void
    {
        $this->getInstructions();
    }

    public function getInstructions(): void
    {
        $instructions = ClientBillingInstruction::where('client_id', $this->client->id)
            ->limit(1)
            ->get();

        $this->instructions = $instructions[0]->instructions;
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>
                Instructions
            </h2>
        </div>
        <div class="card-body">
            @empty ($instructions)
                None entered
            @else
                {!! $instructions !!}
            @endempty
        </div>
    </div>
</div>
