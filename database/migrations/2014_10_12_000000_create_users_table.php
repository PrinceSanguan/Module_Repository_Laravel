<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('password');
            $table->string('section');
            $table->enum('userType', ['admin', 'student', 'teacher'])->default('admin');
            $table->enum('status', ['activate', 'deactivate'])->default('deactivate');
            $table->timestamps();
        });


        // Insert default data
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'Ina V. Nucup',
            'password' => Hash::make('admin'),
            'section' => 'Gumamela',
            'userType' => 'admin',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
