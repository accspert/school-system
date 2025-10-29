<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // CRITICAL CHECK: Ensure role is exactly 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        if (Auth::check()) {
            return redirect('/dashboard')->with('error', 'You do not have administrator privileges.');
        }

        return redirect()->route('login');
    }
}
