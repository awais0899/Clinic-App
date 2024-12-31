<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;

class MenuPolicy
{
    public function update(User $user, Menu $menu): bool
    {
        return $user->isOwner() && $menu->clinic->owner_id === $user->id;
    }

    public function delete(User $user, Menu $menu): bool
    {
        return $user->isOwner() && $menu->clinic->owner_id === $user->id;
    }
}