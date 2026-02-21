<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Asset\Asset;

class AssetPolicy
{
    /**
     * Hanya admin/it_support bisa mengelola aset.
     */
    public function manage(User $user): bool
    {
        return $user->hasRole('admin')
            || $user->hasRole('super_admin')
            || $user->hasRole('it_support');
    }
}
