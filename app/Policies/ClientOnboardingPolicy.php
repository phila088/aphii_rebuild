<?php

namespace App\Policies;

use App\Models\ClientOnboarding;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientOnboardingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientOnboarding $clientOnboarding): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientOnboarding $clientOnboarding): bool
    {
    }

    public function delete(User $user, ClientOnboarding $clientOnboarding): bool
    {
    }

    public function restore(User $user, ClientOnboarding $clientOnboarding): bool
    {
    }

    public function forceDelete(User $user, ClientOnboarding $clientOnboarding): bool
    {
    }
}
