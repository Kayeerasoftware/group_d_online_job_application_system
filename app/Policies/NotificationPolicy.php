<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Notification;
use App\Models\User;

class NotificationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Notification $notification): bool
    {
        return $notification->user_id === $user->id || $user->roleValue() === UserRole::Admin->value;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Notification $notification): bool
    {
        return $this->view($user, $notification);
    }

    public function delete(User $user, Notification $notification): bool
    {
        return $this->view($user, $notification);
    }

    public function restore(User $user, Notification $notification): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function forceDelete(User $user, Notification $notification): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }
}
