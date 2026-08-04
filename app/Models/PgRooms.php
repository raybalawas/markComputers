<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PgRooms extends Model
{
    protected $fillable = [
        'room_no',
        'room_type',
        'status'

    ];

    public function resident()
    {
        return $this->hasOne(PgResident::class, 'room_id');
    }
}
