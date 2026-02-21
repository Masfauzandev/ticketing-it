<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Safe count — returns 0 if table doesn't exist yet
        $safeCount = function (string $table, ?array $where = null) {
            try {
                $q = DB::table($table);
                if ($where) {
                    $q->where($where);
                }
                return $q->count();
            } catch (\Exception $e) {
                return 0;
            }
        };

        $stats = [
            'total_tickets' => $safeCount('tickets'),
            'open_tickets' => $safeCount('tickets', ['status' => 'open']),
            'devices_online' => $safeCount('network_devices', ['status' => 'online']),
            'devices_total' => $safeCount('network_devices'),
            'total_assets' => $safeCount('assets'),
            'guide_articles' => $safeCount('guides'),
        ];

        return view('dashboard', compact('stats'));
    }
}
