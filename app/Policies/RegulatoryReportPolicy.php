<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\RegulatoryReport;
use App\Models\User;

class RegulatoryReportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function view(User $user, RegulatoryReport $regulatoryReport): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function create(User $user): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function update(User $user, RegulatoryReport $regulatoryReport): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function delete(User $user, RegulatoryReport $regulatoryReport): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function restore(User $user, RegulatoryReport $regulatoryReport): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function forceDelete(User $user, RegulatoryReport $regulatoryReport): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }
}
