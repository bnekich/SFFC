<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ForcePasswordReset
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            $user = auth()->user();

            // Check if the user is required to reset their password
            if ($user->force_password_reset) {
                // Skip redirection if the user is already on password reset or update routes
                $currentRoute = $request->route()->getName();
                if (in_array($currentRoute, ['password.reset', 'password.update'])) {
                    return $next($request);
                }

                // Generate a password reset token
                $token = Password::broker()->createToken($user);

                // Redirect to the password reset form with the token and email
                return redirect()->route('password.reset', [
                    'token' => $token,
                    'email' => $user->email,
                ]);
            }
        }

        // If no password reset is required, proceed with the request
        return $next($request);
    }
}
