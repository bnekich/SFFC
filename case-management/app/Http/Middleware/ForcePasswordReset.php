<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForcePasswordReset
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (
            $request->user() && $request->user()->force_password_reset &&
            !in_array($request->route()->getName(), ['password.reset', 'password.update'])
        ) {
            return redirect()->route('password.reset');
        }
        return $next($request);
    }
}
