<?php

namespace App\Policies;

use App\Models\Clinic;
use App\Models\User;

class ClinicPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    public function view(User $user, Clinic $clinic): bool
    {
        return $user->isOwner() && $clinic->owner_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    public function update(User $user, Clinic $clinic): bool
    {
        return $user->isOwner() && $clinic->owner_id === $user->id;
    }

    public function delete(User $user, Clinic $clinic): bool
    {
        return $user->isOwner() && $clinic->owner_id === $user->id;
    }
}