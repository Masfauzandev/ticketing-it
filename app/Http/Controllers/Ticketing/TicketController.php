<?php

namespace App\Http\Controllers\Ticketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        // TODO: List tickets
        return view('ticketing.index');
    }

    public function create()
    {
        return view('ticketing.create');
    }

    public function store(Request $request)
    {
        // TODO: Store new ticket
    }

    public function show($id)
    {
        // TODO: Show ticket detail
        return view('ticketing.show');
    }

    public function update(Request $request, $id)
    {
        // TODO: Update ticket
    }
}
