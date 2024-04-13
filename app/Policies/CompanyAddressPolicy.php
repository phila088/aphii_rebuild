<?php

namespace App\Policies;

use App\Models\CompanyAddress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyAddressPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, CompanyAddress $companyAddress): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, CompanyAddress $companyAddress): bool
    {
    }

    public function delete(User $user, CompanyAddress $companyAddress): bool
    {
    }

    public function restore(User $user, CompanyAddress $companyAddress): bool
    {
    }

    public function forceDelete(User $user, CompanyAddress $companyAddress): bool
    {
    }
}
