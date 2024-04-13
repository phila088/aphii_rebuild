<?php

namespace App\Policies;

use App\Models\CompanyEmail;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyEmailPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, CompanyEmail $companyEmail): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, CompanyEmail $companyEmail): bool
    {
    }

    public function delete(User $user, CompanyEmail $companyEmail): bool
    {
    }

    public function restore(User $user, CompanyEmail $companyEmail): bool
    {
    }

    public function forceDelete(User $user, CompanyEmail $companyEmail): bool
    {
    }
}
