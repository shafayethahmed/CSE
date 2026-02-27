<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1Check if user is logged in
        if (!Auth::check()) {
            abort(403, 'Access denied. You must be logged in to view this page.');
        }

        //  Check if the user role is allowed
        $allowedRoles = ['user', 'staff', 'department-head', 'super-admin'];
        $userRole = Auth::user()->role;

        if (!in_array($userRole, $allowedRoles, true)) {
            abort(403, 'Access denied. Your role does not have permission.');
        }

        //  All checks passed, allow request
        //return $next($request);
        $response = $next($request);
        return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
    }
}