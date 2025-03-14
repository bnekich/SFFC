<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function show()
    {
        return view('admin.users.reset-password');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->force_password_reset = false;
        $user->save();

        auth()->login($user);

        return redirect()->route('dashboard')->with('status', 'Password updated successfully');
    }
}
