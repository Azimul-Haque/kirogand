<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdminMiddleware
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
        if(!Auth::check() || Auth::user()->role != 'admin'){
            abort(403, 'Access Denied');
        }

        // 1. Ensure the user is authenticated
        if (!Auth::check()) {
            abort(403, 'Access Denied');
        }

        $user = Auth::user();

        // 2. Check for the OR condition: Admin OR Manager
        // You MUST have isAdmin() and isManager() methods on your User model 
        // that return boolean true/false based on the user's role.
        if ($user->isAdmin() || $user->isManager()) {
            return $next($request);
        }

        // 3. If neither role is met, deny access
        return abort(403, 'Access Denied. Requires Admin or Manager role.');
        return $next($request);
    }
}
