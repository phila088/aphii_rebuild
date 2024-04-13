<?php

namespace App\Policies;

use App\Models\CompanyHour;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyHourPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, CompanyHour $companyHour): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, CompanyHour $companyHour): bool
    {
    }

    public function delete(User $user, CompanyHour $companyHour): bool
    {
    }

    public function restore(User $user, CompanyHour $companyHour): bool
    {
    }

    public function forceDelete(User $user, CompanyHour $companyHour): bool
    {
    }
}
