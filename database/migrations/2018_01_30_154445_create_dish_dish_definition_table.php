<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishDishDefinitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_dish_definition', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('dish_id')->unsigned();
            $table->foreign('dish_id')->references('id')->on('dishes');

            $table->integer('dish_definition_id')->unsigned();
            $table->foreign('dish_definition_id')->references('id')->on('dish_definitions');

            $table->decimal('value')->default(0.00);

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
        Schema::dropIfExists('dish_dish_definition');
    }
}
