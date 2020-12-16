<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Umkm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('danger', 'Login terlebih dahulu');
        }

        if (Auth::user()->role == 1) {
            return redirect('/pengelola');
        }

        if (Auth::user()->role == 2) {
            return $next($request);
        }
    }
}
