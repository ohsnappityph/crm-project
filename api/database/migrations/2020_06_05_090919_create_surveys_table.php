<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('num_units');
            $table->string('num_units_bldg')->nullable();
            $table->string('bldg_or_units')->nullable();
            $table->string('total_non_resident_units')->nullable();
            $table->string('total_sqft_non_resident')->nullable();
            $table->string('total_resident_units')->nullable();
            $table->string('total_sqft_resident')->nullable();
            $table->string('building_type');
            $table->string('survey_instructions');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('surveys', function (Blueprint $table) {
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
        Schema::dropIfExists('surveys');
    }
}
