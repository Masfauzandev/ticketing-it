<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

    /**
     * Update module status via AJAX (admin only)
     */
    public function updateModuleStatus(Request $request)
    {
        $request->validate([
            'module' => 'required|string',
            'status' => 'required|in:aktif,on_progress,nonaktif',
        ]);

        $configPath = config_path('modules.php');
        $modules = config('modules', []);

        if (!isset($modules[$request->module])) {
            return response()->json(['success' => false, 'message' => 'Module not found'], 404);
        }

        $modules[$request->module]['status'] = $request->status;

        // Write back to config file
        $content = "<?php\n\n/**\n * Konfigurasi Modul IT System Gasindogroup.\n *\n * Setiap modul didefinisikan di sini dengan nama, deskripsi,\n * ikon, route, permission yang dibutuhkan, warna kartu, dan status.\n *\n * Status: aktif, on_progress, nonaktif\n */\nreturn " . var_export($modules, true) . ";\n";

        // Clean up var_export output
        $content = str_replace("array (", "[", $content);
        $content = str_replace(")", "]", $content);
        $content = preg_replace('/=>\s*\n\s*\[/', '=> [', $content);

        File::put($configPath, $content);

        return response()->json([
            'success' => true,
            'message' => __('messages.system_status_updated'),
        ]);
    }
}
