<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\JobSeekerProfile;
use App\Models\User;

class JobSeekerProfilePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, JobSeekerProfile $jobSeekerProfile): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $this->isSeekerOrAdmin($user);
    }

    public function update(User $user, JobSeekerProfile $jobSeekerProfile): bool
    {
        return $this->isAdmin($user) || $jobSeekerProfile->user_id === $user->id;
    }

    public function delete(User $user, JobSeekerProfile $jobSeekerProfile): bool
    {
        return $this->update($user, $jobSeekerProfile);
    }

    public function restore(User $user, JobSeekerProfile $jobSeekerProfile): bool
    {
        return $this->isAdmin($user);
    }

    public function forceDelete(User $user, JobSeekerProfile $jobSeekerProfile): bool
    {
        return $this->isAdmin($user);
    }

    private function isSeekerOrAdmin(User $user): bool
    {
        return $user->roleValue() === UserRole::Seeker->value || $user->roleValue() === UserRole::Admin->value;
    }

    private function isAdmin(User $user): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }
}
