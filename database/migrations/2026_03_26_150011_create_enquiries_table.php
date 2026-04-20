<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('course_name');
            $table->decimal('total_fees', 10, 2)->default(0);
            $table->decimal('due_fees', 10, 2)->default(0);
            $table->decimal('revenue_fees', 10, 2)->default(0);
            $table->string('image')->nullable();
            $table->string('docs')->nullable();
            // $table->string('batch_time')->nullable();
            $table->time('batch_start_time')->nullable();
            $table->time('batch_end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
