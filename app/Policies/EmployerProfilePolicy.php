<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\EmployerProfile;
use App\Models\User;

class EmployerProfilePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, EmployerProfile $employerProfile): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $this->isEmployerOrAdmin($user);
    }

    public function update(User $user, EmployerProfile $employerProfile): bool
    {
        return $this->isAdmin($user) || $employerProfile->user_id === $user->id;
    }

    public function delete(User $user, EmployerProfile $employerProfile): bool
    {
        return $this->update($user, $employerProfile);
    }

    public function restore(User $user, EmployerProfile $employerProfile): bool
    {
        return $this->isAdmin($user);
    }

    public function forceDelete(User $user, EmployerProfile $employerProfile): bool
    {
        return $this->isAdmin($user);
    }

    private function isEmployerOrAdmin(User $user): bool
    {
        return $user->roleValue() === UserRole::Employer->value || $user->roleValue() === UserRole::Admin->value;
    }

    private function isAdmin(User $user): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }
}
