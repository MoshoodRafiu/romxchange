<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('password');
            $table->string('is_agent')->default(0);
            $table->string('is_admin')->default(0);
            $table->string('is_active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'display_name' => 'Admin',
            'email' => 'admin@devrom.tech',
            'password' => Hash::make('password'),
            'is_agent' => 1,
            'is_admin' => 1,
        ]);

        DB::table('users')->insert([
            'display_name' => 'devRom',
            'email' => 'demo@devrom.tech',
            'password' => Hash::make('password'),
            'is_agent' => 0,
            'is_admin' => 0,
        ]);

        DB::table('verifications')->insert([
            'user_id' => 2,
            'is_email_verified' => 1,
            'is_phone_verified' => 1,
            'is_document_verified' => 1,
            'document_verification_status' => 'approved',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'document_verified_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
