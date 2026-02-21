<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleAccess
{
    /**
     * Cek apakah user memiliki akses ke modul tertentu.
     *
     * Digunakan di route group per-modul:
     * Route::middleware(['auth', 'module:ticketing'])->group(...)
     */
    public function handle(Request $request, Closure $next, string $module): Response
    {
        $permission = "module.{$module}";

        if (!$request->user() || !$request->user()->hasPermission($permission)) {
            abort(403, 'Anda tidak memiliki akses ke modul ini.');
        }

        return $next($request);
    }
}
