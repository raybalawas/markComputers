<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'category_id',
        'course_name',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
