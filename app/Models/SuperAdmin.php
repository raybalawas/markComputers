<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SuperAdmin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'super_admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',  // Add this field to your migration
        'role',       // Add this field for role management
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Check if super admin is active
    public function isActive()
    {
        return $this->is_active;
    }

    // Check role (if you want multiple admin levels)
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Check if super admin (you can have different admin types)
    public function isSuperAdmin()
    {
        return $this->role === 'super-admin' || $this->role === 'super_admin';
    }
}