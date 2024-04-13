<?php

namespace App\Policies;

use App\Models\Certification;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CertificationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Certification $certification): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Certification $certification): bool
    {
    }

    public function delete(User $user, Certification $certification): bool
    {
    }

    public function restore(User $user, Certification $certification): bool
    {
    }

    public function forceDelete(User $user, Certification $certification): bool
    {
    }
}
