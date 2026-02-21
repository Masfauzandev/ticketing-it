<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticketing\Ticket;

class TicketPolicy
{
    /**
     * User hanya bisa melihat tiket miliknya atau jika dia agent/admin.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->creator_id
            || $user->id === $ticket->assigned_to
            || $user->hasRole('admin')
            || $user->hasRole('super_admin');
    }

    /**
     * User hanya bisa update tiket tertentu.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->assigned_to
            || $user->hasRole('admin')
            || $user->hasRole('super_admin');
    }
}
