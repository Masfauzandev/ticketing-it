<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserGuide\Guide;

class GuidePolicy
{
    /**
     * Semua user bisa melihat guide yang sudah dipublish.
     */
    public function view(User $user, Guide $guide): bool
    {
        return $guide->is_published || $user->hasRole('admin') || $user->hasRole('super_admin');
    }

    /**
     * Hanya admin/author yang bisa edit guide.
     */
    public function update(User $user, Guide $guide): bool
    {
        return $user->id === $guide->author_id
            || $user->hasRole('admin')
            || $user->hasRole('super_admin');
    }
}
