<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('is_email_verified')->default(0);
            $table->boolean('is_phone_verified')->default(0);
            $table->boolean('is_document_verified')->default(0);
            $table->string('document_verification_status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('document_verified_at')->nullable();
            $table->timestamps();
        });

        DB::table('verifications')->insert([
            'user_id' => 1,
            'is_email_verified' => 1,
            'is_phone_verified' => 1,
            'is_document_verified' => 1,
            'document_verification_status' => 'approved',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'document_verified_at' => now()
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
        Schema::dropIfExists('verifications');
    }
}
