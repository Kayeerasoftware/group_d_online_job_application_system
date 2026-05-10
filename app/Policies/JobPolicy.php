<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Job $job): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $this->isEmployerOrAdmin($user);
    }

    public function update(User $user, Job $job): bool
    {
        return $this->isAdmin($user) || ($this->isEmployer($user) && $job->employer_id === $user->id);
    }

    public function delete(User $user, Job $job): bool
    {
        return $this->update($user, $job);
    }

    public function restore(User $user, Job $job): bool
    {
        return $this->isAdmin($user);
    }

    public function forceDelete(User $user, Job $job): bool
    {
        return $this->isAdmin($user);
    }

    private function isEmployer(User $user): bool
    {
        return $user->roleValue() === UserRole::Employer->value;
    }

    private function isAdmin(User $user): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    private function isEmployerOrAdmin(User $user): bool
    {
        return $this->isEmployer($user) || $this->isAdmin($user);
    }
}
