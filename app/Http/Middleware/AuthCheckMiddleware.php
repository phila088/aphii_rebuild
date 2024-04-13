<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->locked || !auth()->user()->active) {
            auth()->logout();

            return redirect()->route('login');
        }

        return $next($request);
    }
}
