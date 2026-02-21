<?php

namespace App\Services;

/**
 * Business logic untuk modul Ticketing.
 */
class TicketService
{
    /**
     * Generate nomor tiket unik (contoh: TKT-20260222-0001)
     */
    public function generateTicketNumber(): string
    {
        // TODO: Implement auto-increment ticket number
        return 'TKT-' . date('Ymd') . '-' . str_pad(1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Assign tiket ke agent.
     */
    public function assignTicket(int $ticketId, int $agentId): void
    {
        // TODO: Implement assignment logic + history log
    }

    /**
     * Update status tiket.
     */
    public function updateStatus(int $ticketId, string $newStatus): void
    {
        // TODO: Implement status update + history log
    }
}
