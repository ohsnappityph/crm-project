<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('property_address');
            $table->date('appointment_date');
            $table->decimal('total_sqfootage');
            $table->text('comments');
            $table->text('private_comments');
            $table->string('surveyor_name');
            $table->string('surveyor_paid');
            $table->decimal('surveyor_amount_paid');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('payrolls', function (Blueprint $table) {
            $table->foreign('user_id')
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
        Schema::dropIfExists('payrolls');
    }
}
