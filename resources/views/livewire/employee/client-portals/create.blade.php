<?php

use App\Models\Client;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {
    public Client $client;

    public string $name = '';
    public string $description = '';
    public string $url = '';

    public function store(): void
    {

    }
}; ?>

<div>
    <form wire:submit="store"></form>
</div>
