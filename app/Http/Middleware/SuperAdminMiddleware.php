<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if super admin is authenticated
        if (!Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.login')
                ->with('error', 'Please login to access the dashboard.');
        }

        // Optional: Add additional role/status checks
        $superAdmin = Auth::guard('superadmin')->user();

        // Check if super admin is active (if you have an 'is_active' field)
        if (property_exists($superAdmin, 'is_active') && !$superAdmin->is_active) {
            Auth::guard('superadmin')->logout();
            return redirect()->route('superadmin.login')
                ->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
