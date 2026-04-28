<?php

namespace App\Policies;

use App\Models\JobListing;
use App\Models\User;

class JobPolicy
{
    public function update(User $user, JobListing $job): bool
    {
        return $user->id === $job->user_id;
    }

    public function delete(User $user, JobListing $job): bool
    {
        return $user->id === $job->user_id;
    }
}
