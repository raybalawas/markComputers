<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    /**
     * Check if super admin is logged in
     */
    public static function isSuperAdminLoggedIn()
    {
        return Auth::guard('superadmin')->check();
    }

    /**
     * Get current super admin user
     */
    public static function getCurrentSuperAdmin()
    {
        return Auth::guard('superadmin')->user();
    }

    /**
     * Check if current user has specific role
     */
    public static function hasRole($role)
    {
        $user = self::getCurrentSuperAdmin();
        return $user && $user->role === $role;
    }

    /**
     * Check if current user is active
     */
    public static function isActive()
    {
        $user = self::getCurrentSuperAdmin();
        return $user && $user->is_active;
    }
}
