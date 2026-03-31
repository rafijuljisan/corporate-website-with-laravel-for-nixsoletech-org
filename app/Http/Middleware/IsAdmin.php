<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Check if the user is logged in AND their is_admin flag is true (1)
    if (auth()->check() && auth()->user()->is_admin) {
        return $next($request);
    }

    // If they are just a regular user, kick them back to the homepage with an error
    return redirect('/')->with('error', 'You do not have admin access.');
}
}
