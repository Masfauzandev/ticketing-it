<?php

namespace App\Http\Controllers\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        // TODO: List network alerts
        return view('monitoring.alerts.index');
    }

    public function resolve($id)
    {
        // TODO: Mark alert as resolved
    }
}
