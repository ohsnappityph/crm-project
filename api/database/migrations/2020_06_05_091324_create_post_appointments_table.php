<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->date('delivery_date');
            $table->date('invoice_date');
            $table->decimal('actual_sqft');
            $table->string('survey_quality');
            $table->string('paid');
            $table->date('date_paid');
            $table->string('payment_method');
            $table->text('payment_notes');
            $table->string('last_four_cc');
            $table->decimal('amount_paid');
            $table->integer('allocated_time');
            $table->text('surveyor_in_out_times');
            $table->decimal('amount_paid_surveyor');
            $table->string('surveyor_paid');
            $table->text('important_comments');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('post_appointments', function (Blueprint $table) {
            $table->foreign('order_id')
                    ->references('id')->on('projects')
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
        Schema::dropIfExists('post_appointments');
    }
}
