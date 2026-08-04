<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pg_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_no')->unique(); // e.g., 101, 102
            $table->string('room_type'); // single, double, triple
            $table->string('status')->default('available'); // available, occupied, maintenance
            // $table->foreignId('resident_id')->nullable()->constrained('pg_residents')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pg_rooms');
    }
};