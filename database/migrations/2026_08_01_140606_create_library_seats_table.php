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
        Schema::create('library_seats', function (Blueprint $table) {
            $table->id();
            $table->integer('seat_number')->unique();
            $table->enum('status', ['available', 'occupied', 'reserved'])->default('available');
            $table->foreignId('library_student_id')->nullable()->constrained('library_students')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_seats');
    }
};
