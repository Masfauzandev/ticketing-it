<?php

namespace App\Http\Controllers\Ticketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index()
    {
        // TODO: List ticket categories
        return view('ticketing.categories.index');
    }

    public function store(Request $request)
    {
        // TODO: Store new category
    }

    public function update(Request $request, $id)
    {
        // TODO: Update category
    }

    public function destroy($id)
    {
        // TODO: Delete category
    }
}
