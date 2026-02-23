<?php

namespace App\Http\Controllers\Ticketing;

use App\Http\Controllers\Controller;
use App\Models\Ticketing\Ticket;
use App\Models\Ticketing\TicketCategory;
use App\Models\User;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * Halaman listing tiket.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Ticket::with(['creator', 'assignee', 'category']);

        // User biasa hanya lihat tiket sendiri, admin/agent lihat semua
        if ($request->has('filter') && $request->filter === 'my') {
            $query->where('creator_id', $user->id);
        } else {
            if (!$user->hasRole('super_admin') && !$user->hasRole('admin') && !$user->hasRole('agent')) {
                $query->where('creator_id', $user->id);
            }
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Stats
        $statsBase = Ticket::query();
        if ($request->has('filter') && $request->filter === 'my') {
            $statsBase->where('creator_id', $user->id);
        } else {
            if (!$user->hasRole('super_admin') && !$user->hasRole('admin') && !$user->hasRole('agent')) {
                $statsBase->where('creator_id', $user->id);
            }
        }

        $stats = [
            'total' => (clone $statsBase)->count(),
            'open' => (clone $statsBase)->where('status', 'open')->count(),
            'in_progress' => (clone $statsBase)->where('status', 'in_progress')->count(),
            'resolved' => (clone $statsBase)->where('status', 'resolved')->count(),
            'closed' => (clone $statsBase)->where('status', 'closed')->count(),
        ];

        $tickets = $query->orderByDesc('created_at')->paginate(15)->withQueryString();
        $categories = TicketCategory::where('is_active', true)->get();

        return view('ticketing.index', compact('tickets', 'stats', 'categories'));
    }

    /**
     * Form buat tiket baru.
     */
    public function create()
    {
        $categories = TicketCategory::where('is_active', true)->get();
        return view('ticketing.create', compact('categories'));
    }

    /**
     * Simpan tiket baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:ticket_categories,id',
            'priority' => 'required|in:low,medium,high,critical',
            'attachments.*' => 'nullable|file|max:10240', // max 10MB per file
        ]);

        $ticket = $this->ticketService->createTicket($validated, Auth::id());

        // Upload attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $this->ticketService->storeAttachment($ticket, $file);
            }
        }

        return redirect()->route('ticketing.show', $ticket)
            ->with('success', 'Tiket berhasil dibuat dengan nomor ' . $ticket->ticket_number);
    }

    /**
     * Detail tiket.
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket->load([
            'creator',
            'assignee',
            'category',
            'comments.user',
            'attachments',
            'histories.user'
        ]);

        // Get agents for assignment dropdown (admin/agent only)
        $agents = null;
        $user = Auth::user();
        if ($user->hasRole('super_admin') || $user->hasRole('admin') || $user->hasRole('agent')) {
            $agents = User::whereHas('roles', function ($q) {
                $q->whereIn('name', ['super_admin', 'admin', 'agent']);
            })->get();
        }

        return view('ticketing.show', compact('ticket', 'agents'));
    }

    /**
     * Update tiket (status, priority, assignment).
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        if ($request->filled('status')) {
            $request->validate(['status' => 'in:open,in_progress,resolved,closed']);
            $this->ticketService->updateStatus($ticket, $request->status);
        }

        if ($request->filled('priority')) {
            $request->validate(['priority' => 'in:low,medium,high,critical']);
            $this->ticketService->updatePriority($ticket, $request->priority);
        }

        if ($request->has('assigned_to')) {
            $request->validate(['assigned_to' => 'nullable|exists:users,id']);
            $this->ticketService->assignTicket($ticket, $request->assigned_to);
        }

        // Add comment
        if ($request->filled('comment')) {
            $this->ticketService->addComment(
                $ticket,
                $request->comment,
                $request->boolean('is_internal', false)
            );

            // Upload comment attachments
            if ($request->hasFile('comment_attachments')) {
                $comment = $ticket->comments()->latest()->first();
                foreach ($request->file('comment_attachments') as $file) {
                    $this->ticketService->storeAttachment($ticket, $file, $comment->id);
                }
            }
        }

        return redirect()->route('ticketing.show', $ticket)
            ->with('success', 'Tiket berhasil diperbarui.');
    }
}
