<?php

namespace App\Policies;

use App\Models\State;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, State $state): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, State $state): bool
    {
    }

    public function delete(User $user, State $state): bool
    {
    }

    public function restore(User $user, State $state): bool
    {
    }

    public function forceDelete(User $user, State $state): bool
    {
    }
}
