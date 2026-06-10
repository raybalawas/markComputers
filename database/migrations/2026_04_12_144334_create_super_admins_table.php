<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('super_admins')) {
            Schema::create('super_admins', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('email')->unique();
                $table->string('password');
                $table->boolean('is_active')->default(true);
                $table->string('role')->default('super-admin');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    } 

    public function down()
    {
        Schema::table('super_admins', function (Blueprint $table) {
            $table->dropColumn(['name', 'is_active', 'role', 'remember_token']);
        });
    }
};
