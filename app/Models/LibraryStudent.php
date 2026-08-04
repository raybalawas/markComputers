<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryStudent extends Model
{
    protected $fillable = [
        'member_code',
        'name',
        'phone',
        'email',
        'address',
        'fee',
        'seat',
        'membership_date',
        'status'
    ];

     protected $casts = [
        'membership_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->member_code)) {
                $model->member_code = 'LIB-' . strtoupper(uniqid());
            }
        });
    }
}