<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard dengan modul yang bisa diakses user.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $modules = collect(config('modules'))->filter(function ($module) use ($user) {
            return $user->hasPermission($module['permission']);
        });

        return view('dashboard', compact('modules'));
    }
}
