<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'course_name',
        'total_fees',
        'due_fees',
        'revenue_fees',
        'image',
        'docs',
        // 'batch_time',
        'batch_start_time',
        'batch_end_time',
        'father_name',
        'mother_name',
        'dob',
        'category',
        'gender',
        'marital_status',
        'address',
        'aadhar_number',
        'qualification',
        'pin_code',
        'admission_date',
        'book_issue',
        'parent_signature',
        'center_head_signature'
    ];

    protected $casts = [
        'docs' => 'array',
    ];
}
