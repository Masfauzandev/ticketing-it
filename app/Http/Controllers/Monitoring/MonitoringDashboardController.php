<?php

namespace App\Http\Controllers\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonitoringDashboardController extends Controller
{
    public function index()
    {
        // TODO: Network monitoring dashboard
        return view('monitoring.dashboard');
    }
}
