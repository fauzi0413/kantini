<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->user()->role == $role) {
            return $next($request);
        } else {
            if (auth()->user()->role == 'admin') {
                return redirect('/admin');
            } else if (auth()->user()->role == 'penjual') {
                return redirect('/penjual');
            } else if (auth()->user()->role == 'user') {
                return redirect('/');
            }
        }
    }
}
