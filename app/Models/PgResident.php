<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PgResident extends Model
{
    protected $fillable = [
        'resident_code',
        'name',
        'phone',
        'aadhar',
        'email',
        'address',
        'fee',
        'joining_date',
        'status',
        'room_id',
        'aadhar_image'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'aadhar_image' => 'array',
    ];

    public function room()
    {
        return $this->belongsTo(PgRooms::class);
    }
}