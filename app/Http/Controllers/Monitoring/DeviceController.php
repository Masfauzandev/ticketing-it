<?php

namespace App\Http\Controllers\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        // TODO: List network devices
        return view('monitoring.devices.index');
    }

    public function create()
    {
        return view('monitoring.devices.create');
    }

    public function store(Request $request)
    {
        // TODO: Store new device
    }

    public function show($id)
    {
        // TODO: Show device detail & uptime history
        return view('monitoring.devices.show');
    }

    public function update(Request $request, $id)
    {
        // TODO: Update device
    }

    public function destroy($id)
    {
        // TODO: Delete device
    }
}
