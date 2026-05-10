<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\SavedJob;
use App\Models\User;

class SavedJobPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SavedJob $savedJob): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->roleValue() === UserRole::Seeker->value || $user->roleValue() === UserRole::Admin->value;
    }

    public function update(User $user, SavedJob $savedJob): bool
    {
        return $user->roleValue() === UserRole::Admin->value || $savedJob->job_seeker_id === $user->id;
    }

    public function delete(User $user, SavedJob $savedJob): bool
    {
        return $this->update($user, $savedJob);
    }

    public function restore(User $user, SavedJob $savedJob): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function forceDelete(User $user, SavedJob $savedJob): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }
}
