<?php

namespace App\Services;

use App\Models\Ticketing\Ticket;
use App\Models\Ticketing\TicketComment;
use App\Models\Ticketing\TicketHistory;
use App\Models\Ticketing\TicketAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketService
{
    /**
     * Generate nomor tiket unik: TKT-0001, TKT-0002, ...
     */
    public function generateTicketNumber(): string
    {
        $last = Ticket::orderByDesc('id')->first();
        $nextNum = $last ? ($last->id + 1) : 1;
        return 'TKT-' . str_pad($nextNum, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new ticket.
     */
    public function createTicket(array $data, int $creatorId): Ticket
    {
        return DB::transaction(function () use ($data, $creatorId) {
            $ticket = Ticket::create([
                'ticket_number' => $this->generateTicketNumber(),
                'subject' => $data['subject'],
                'description' => $data['description'],
                'priority' => $data['priority'] ?? 'medium',
                'category_id' => $data['category_id'],
                'creator_id' => $creatorId,
                'status' => 'open',
            ]);

            // Log creation history
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => $creatorId,
                'field' => 'created',
                'old_value' => null,
                'new_value' => 'Tiket dibuat',
            ]);

            return $ticket;
        });
    }

    /**
     * Assign tiket ke agent.
     */
    public function assignTicket(Ticket $ticket, ?int $agentId): void
    {
        $oldAssignee = $ticket->assigned_to;
        $ticket->update(['assigned_to' => $agentId]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'field' => 'assigned_to',
            'old_value' => $oldAssignee,
            'new_value' => $agentId,
        ]);
    }

    /**
     * Update status tiket.
     */
    public function updateStatus(Ticket $ticket, string $newStatus): void
    {
        $oldStatus = $ticket->status;
        $updateData = ['status' => $newStatus];

        if ($newStatus === 'resolved') {
            $updateData['resolved_at'] = now();
        } elseif ($newStatus === 'closed') {
            $updateData['closed_at'] = now();
        }

        $ticket->update($updateData);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'field' => 'status',
            'old_value' => $oldStatus,
            'new_value' => $newStatus,
        ]);
    }

    /**
     * Update priority tiket.
     */
    public function updatePriority(Ticket $ticket, string $newPriority): void
    {
        $oldPriority = $ticket->priority;
        $ticket->update(['priority' => $newPriority]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'field' => 'priority',
            'old_value' => $oldPriority,
            'new_value' => $newPriority,
        ]);
    }

    /**
     * Add a comment to a ticket.
     */
    public function addComment(Ticket $ticket, string $body, bool $isInternal = false): TicketComment
    {
        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'body' => $body,
            'is_internal' => $isInternal,
        ]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'field' => 'comment',
            'old_value' => null,
            'new_value' => 'Komentar ditambahkan',
        ]);

        return $comment;
    }

    /**
     * Store attachment for a ticket.
     */
    public function storeAttachment(Ticket $ticket, $file, ?int $commentId = null): TicketAttachment
    {
        $filename = $file->getClientOriginalName();
        $path = $file->store('ticket-attachments/' . $ticket->id, 'public');
        $size = $file->getSize();

        return TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'comment_id' => $commentId,
            'filename' => $filename,
            'path' => $path,
            'size' => $size,
        ]);
    }
}
