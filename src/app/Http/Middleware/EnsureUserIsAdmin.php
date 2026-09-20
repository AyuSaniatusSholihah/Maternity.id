<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has account_type = 'admin'
        if (auth()->check() && auth()->user()->account_type === 'admin') {
            return $next($request);
        }

        // Redirect to home if not admin
        return redirect()->route('home');
    }
}
