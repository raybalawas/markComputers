<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('father_name')->nullable()->after('name');
            $table->string('mother_name')->nullable()->after('father_name');
            $table->date('dob')->nullable()->after('mother_name');
            $table->string('category')->nullable()->after('dob');
            $table->string('gender')->nullable()->after('category');
            $table->string('marital_status')->nullable()->after('gender');
            $table->text('address')->nullable()->after('marital_status');
            $table->string('aadhar_number')->nullable()->after('phone_number');
            $table->string('qualification')->nullable()->after('aadhar_number');
            $table->string('pin_code')->nullable()->after('qualification');
            $table->date('admission_date')->nullable()->after('revenue_fees');
            $table->string('book_issue')->default('Pending')->after('admission_date');
            $table->string('parent_signature')->nullable()->after('book_issue');
            $table->string('center_head_signature')->nullable()->after('parent_signature');
        });
    }

    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn([
                'father_name', 'mother_name', 'dob', 'category', 'gender',
                'marital_status', 'address', 'aadhar_number', 'qualification',
                'pin_code', 'admission_date', 'book_issue', 'parent_signature',
                'center_head_signature'
            ]);
        });
    }
};