<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_id');
            $table->date('date');
            $table->date('time_start');
            $table->date('break_start');
            $table->date('break_end');
            $table->date('lunch_start');
            $table->date('lunch_end');
            $table->date('time_end');
            $table->date('hours_worked');
            $table->date('hours_off');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('timesheets', function (Blueprint $table) {
            $table->foreign('attendance_id')
                    ->references('id')->on('attendances')
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
        Schema::dropIfExists('timesheets');
    }
}
