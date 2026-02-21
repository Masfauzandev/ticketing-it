<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
        ]);

        // Find user matching both username AND email
        $user = User::where('username', $request->username)
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return back()
                ->withInput()
                ->withErrors(['username' => __('messages.reset_user_not_found')]);
        }

        if (!$user->is_active) {
            return back()
                ->withInput()
                ->withErrors(['username' => __('messages.account_disabled')]);
        }

        // Generate new random password
        $newPassword = Str::random(10);

        // Update password
        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        // Send email
        Mail::to($user->email)->send(new ResetPasswordMail($user, $newPassword));

        return redirect('/login')
            ->with('success', __('messages.reset_success'));
    }
}
