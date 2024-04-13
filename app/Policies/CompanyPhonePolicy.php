<?php

namespace App\Policies;

use App\Models\CompanyPhone;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPhonePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, CompanyPhone $companyPhone): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, CompanyPhone $companyPhone): bool
    {
    }

    public function delete(User $user, CompanyPhone $companyPhone): bool
    {
    }

    public function restore(User $user, CompanyPhone $companyPhone): bool
    {
    }

    public function forceDelete(User $user, CompanyPhone $companyPhone): bool
    {
    }
}
