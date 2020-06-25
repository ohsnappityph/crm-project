<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role');
            $table->string('password');
            $table->string('surveyor_timezone')->nullable();
            $table->string('surveyor_location')->nullable();
            $table->string('surveyor_address')->nullable();
            $table->string('surveyor_state')->nullable();
            $table->string('surveyor_city')->nullable();
            $table->string('surveyor_zip_code')->nullable();
            $table->text('surveyor_schedule_notes')->nullable();
            $table->string('surveyor_color_code')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
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
