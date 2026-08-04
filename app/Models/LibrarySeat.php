<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibrarySeat extends Model
{

    protected $table = 'library_seats';
    protected $fillable = [
        'seat_number',
        'status',
        'library_student_id'
    ];

    protected $casts = [
        'seat_number' => 'integer',
    ];

    // Relationship with LibraryStudent
    public function student()
    {
        return $this->belongsTo(LibraryStudent::class, 'library_student_id');
    }
}
