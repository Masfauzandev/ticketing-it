<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            // Biodata
            'name' => 'required|string|max:255',
            'callname' => 'nullable|string|max:100',
            'gender' => 'required|in:male,female',
            'employee_id' => 'nullable|string|max:50|unique:users,employee_id',
            'department' => 'required|string|max:100',
            'branch' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:users,email',
            // Akun
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'callname' => $request->callname,
            'gender' => $request->gender,
            'employee_id' => $request->employee_id,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'department' => $request->department,
            'branch' => $request->branch,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        // Assign default 'user' role
        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $user->roles()->attach($userRole);
        }

        return redirect('/login')
            ->with('success', __('messages.register_success'));
    }
}
