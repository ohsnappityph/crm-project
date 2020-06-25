<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('surveyor_id');
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->string('surveyor_name');
            $table->date('2nd_appointment_date');
            $table->string('2nd_appointment_time');
            $table->string('2nd_surveyor_name');
            $table->date('calendar_date');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('order_id')
                    ->references('id')->on('projects')
                    ->cascadeOnDelete();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('surveyor_id')
                    ->references('id')->on('users')
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
