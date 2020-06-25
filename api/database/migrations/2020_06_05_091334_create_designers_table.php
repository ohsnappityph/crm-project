<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('designer_id');
            $table->date('due_date');
            $table->string('designer');
            $table->date('pa_completion_date');
            $table->integer('pa_total_time_spent');
            $table->date('rev_request_date');
            $table->date('rev_delivery_date');
            $table->date('rev_completion_date');
            $table->text('project_notes');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('designers', function (Blueprint $table) {
            $table->foreign('order_id')
                    ->references('id')->on('projects')
                    ->cascadeOnDelete();
        });

        Schema::table('designers', function (Blueprint $table) {
            $table->foreign('designer_id')
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
        Schema::dropIfExists('designers');
    }
}
