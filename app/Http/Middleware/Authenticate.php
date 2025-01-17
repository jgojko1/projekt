<?php

namespace App\Http\Middleware;

// middleware for authenticate.php where it redirects to auth.login if not authenticated

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() === false) {
            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
