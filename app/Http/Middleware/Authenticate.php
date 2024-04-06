<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('home');
            
        }
    }


    // public function handle($request, Closure $next)
    public function handle($request, Closure $next, ...$guards)
    {
        if (!auth()->check()) {
            // User is not authenticated, redirect to the login page
            return redirect()->route('home')->with('error', 'Please log in to access dashboard');
        }

        // User is authenticated, allow the request to proceed
        return $next($request);
    }

}
