<?php

namespace App\Policies;

use App\Models\ClientServiceCharge;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientServiceChargePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientServiceCharge $clientServiceCharge): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientServiceCharge $clientServiceCharge): bool
    {
    }

    public function delete(User $user, ClientServiceCharge $clientServiceCharge): bool
    {
    }

    public function restore(User $user, ClientServiceCharge $clientServiceCharge): bool
    {
    }

    public function forceDelete(User $user, ClientServiceCharge $clientServiceCharge): bool
    {
    }
}
