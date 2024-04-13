<?php

namespace App\Policies;

use App\Models\ClientCall;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientCallPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientCall $clientCall): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientCall $clientCall): bool
    {
    }

    public function delete(User $user, ClientCall $clientCall): bool
    {
    }

    public function restore(User $user, ClientCall $clientCall): bool
    {
    }

    public function forceDelete(User $user, ClientCall $clientCall): bool
    {
    }
}
