<?php

namespace App\Policies;

use App\Models\ClientContract;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientContractPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientContract $clientContract): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientContract $clientContract): bool
    {
    }

    public function delete(User $user, ClientContract $clientContract): bool
    {
    }

    public function restore(User $user, ClientContract $clientContract): bool
    {
    }

    public function forceDelete(User $user, ClientContract $clientContract): bool
    {
    }
}
