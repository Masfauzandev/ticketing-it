<?php

namespace App\Http\Controllers\Ticketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketReportController extends Controller
{
    public function index()
    {
        // TODO: Ticket reporting dashboard
        return view('ticketing.reports.index');
    }
}
