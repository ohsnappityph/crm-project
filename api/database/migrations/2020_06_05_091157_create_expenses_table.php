<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->text('blank_field_one');
            $table->decimal('blank_field_one_pennies');
            $table->text('blank_field_two');
            $table->decimal('blank_field_two_pennies');
            $table->decimal('total_expenses');
            $table->decimal('adjusted_total');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('expenses', function (Blueprint $table) {
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
        Schema::dropIfExists('expenses');
    }
}
