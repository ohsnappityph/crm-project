<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScopeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scope_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scope_id');
            $table->unsignedBigInteger('items_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('scope_items', function (Blueprint $table) {
            $table->foreign('scope_id')
                    ->references('id')->on('scopes')
                    ->cascadeOnDelete();
        });

        Schema::table('scope_items', function (Blueprint $table) {
            $table->foreign('items_id')
                    ->references('id')->on('items')
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
        Schema::dropIfExists('scope_items');
    }
}
