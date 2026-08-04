<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pg_residents', function (Blueprint $table) {
            $table->id();
            $table->string('resident_code')->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('aadhar')->nullable();
            $table->json('aadhar_image')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->decimal('fee', 8, 2)->nullable();
            $table->date('joining_date')->default(now());
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->foreignId('room_id')->nullable()->constrained('pg_rooms')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pg_residents');
    }
};
