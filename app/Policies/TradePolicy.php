<?php

namespace App\Policies;

use App\Models\Trade;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TradePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Trade $trade): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Trade $trade): bool
    {
    }

    public function delete(User $user, Trade $trade): bool
    {
    }

    public function restore(User $user, Trade $trade): bool
    {
    }

    public function forceDelete(User $user, Trade $trade): bool
    {
    }
}
