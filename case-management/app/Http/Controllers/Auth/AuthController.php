<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // For now, we will assume all users require 2FA.
            // In a real application, you would likely have a user setting for this.

            // Store user ID for 2FA verification and log them out of the main guard
            $request->session()->put('2fa_user_id', $user->id);
            Auth::logout();

            return redirect()->route('2fa.challenge');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',

        ]);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
