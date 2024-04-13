<?php

namespace App\Policies;

use App\Models\County;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, County $county): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, County $county): bool
    {
    }

    public function delete(User $user, County $county): bool
    {
    }

    public function restore(User $user, County $county): bool
    {
    }

    public function forceDelete(User $user, County $county): bool
    {
    }
}
