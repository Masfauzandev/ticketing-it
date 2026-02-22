<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil user yang sedang login.
     */
    public function show()
    {
        $user = Auth::user();
        $user->load('roles');

        return view('profile.show', compact('user'));
    }

    /**
     * Tampilkan form edit profil.
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update data profil user.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'callname' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'employee_id' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
            'branch' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', __('messages.profile_updated'));
    }
}
