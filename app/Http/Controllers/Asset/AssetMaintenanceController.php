<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetMaintenanceController extends Controller
{
    public function index()
    {
        // TODO: List maintenance records
        return view('asset.maintenance.index');
    }

    public function store(Request $request)
    {
        // TODO: Store maintenance record
    }

    public function update(Request $request, $id)
    {
        // TODO: Update maintenance record
    }
}
