<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->text('description');
            $table->decimal('amount');
            $table->integer('quantity');
            $table->decimal('total_amount');
            $table->date('payment_date');
            $table->string('payment_method');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('payment_items', function (Blueprint $table) {
            $table->foreign('payment_id')
                    ->references('id')->on('payments')
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
        Schema::dropIfExists('payment_items');
    }
}
