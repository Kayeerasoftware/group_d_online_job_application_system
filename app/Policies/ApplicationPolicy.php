<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Application $application): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $this->isSeekerOrAdmin($user);
    }

    public function update(User $user, Application $application): bool
    {
        return $this->isAdmin($user)
            || ($this->isEmployer($user) && $application->job->employer_id === $user->id)
            || ($this->isSeeker($user) && $application->job_seeker_id === $user->id);
    }

    public function delete(User $user, Application $application): bool
    {
        return $this->update($user, $application);
    }

    public function restore(User $user, Application $application): bool
    {
        return $this->isAdmin($user);
    }

    public function forceDelete(User $user, Application $application): bool
    {
        return $this->isAdmin($user);
    }

    private function isSeeker(User $user): bool
    {
        return $user->roleValue() === UserRole::Seeker->value;
    }

    private function isEmployer(User $user): bool
    {
        return $user->roleValue() === UserRole::Employer->value;
    }

    private function isAdmin(User $user): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    private function isSeekerOrAdmin(User $user): bool
    {
        return $this->isSeeker($user) || $this->isAdmin($user);
    }
}
