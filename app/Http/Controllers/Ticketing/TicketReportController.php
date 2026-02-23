<?php

namespace App\Http\Controllers\Ticketing;

use App\Http\Controllers\Controller;
use App\Models\Ticketing\Ticket;
use App\Models\Ticketing\TicketCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketReportController extends Controller
{
    public function index()
    {
        // Stats per status
        $byStatus = Ticket::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Stats per priority
        $byPriority = Ticket::select('priority', DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->pluck('total', 'priority')
            ->toArray();

        // Stats per category
        $byCategory = TicketCategory::withCount('tickets')
            ->orderByDesc('tickets_count')
            ->get();

        // Agent performance
        $agentStats = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['super_admin', 'admin', 'agent']);
        })
            ->withCount([
                'assignedTickets as total_assigned',
                'assignedTickets as resolved_count' => function ($q) {
                    $q->whereIn('status', ['resolved', 'closed']);
                },
            ])
            ->get();

        $totalTickets = Ticket::count();

        // Average resolution time (in hours)
        $avgResolution = Ticket::whereNotNull('resolved_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, resolved_at)) as avg_hours')
            ->value('avg_hours');

        return view('ticketing.reports.index', compact(
            'byStatus',
            'byPriority',
            'byCategory',
            'agentStats',
            'totalTickets',
            'avgResolution'
        ));
    }
}
