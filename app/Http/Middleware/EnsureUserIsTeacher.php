<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsTeacher
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && (Auth::user()->role === 'teacher' || Auth::user()->role === 'admin')) {
            return $next($request);
        }   

        if (Auth::check()) {
            return redirect('/dashboard')->with('error', 'You do not have teacher privileges.');
        }

        return redirect()->route('login');
    }
}
