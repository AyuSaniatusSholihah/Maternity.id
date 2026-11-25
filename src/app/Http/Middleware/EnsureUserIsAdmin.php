<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::check() && Auth::user()->role === 'admin') {
            $user = Auth::user();
            \App\Models\Admin::firstOrCreate(
                ['account_id' => $user->id],
                [
                    'name' => $user->name ?? 'Administrator',
                    'email' => $user->email,
                    'phone' => '081234567890',
                    'role' => 'active',
                ]
            );

            return $next($request);
        }

        return Auth::check()
            ? redirect()->route('home')
            : redirect()->route('admin.login');
    }
}
