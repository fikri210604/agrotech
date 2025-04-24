<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu.');
        }
        // Get the authenticated user
        $user = auth()->user();
        // Check if the user has the required role
        if ($user->role_id != 1) {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        // Proceed with the request if the user has the required role
        
        return $next($request);
    }
}
