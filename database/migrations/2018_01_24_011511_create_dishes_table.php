<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 500)->nullable();
            $table->decimal('votes')->default('0.0');
            $table->decimal('value');
            $table->string('image')->nullable();
            
            $table->integer('dish_definitions_id')->unsigned();
            $table->foreign('dish_definitions_id')->references('id')->on('dish_definitions');

            $table->integer('restaurant_id')->unsigned();
            $table->foreign('restaurant_id')->references('id')->on('restaurants');

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
        Schema::dropIfExists('dishes');
    }
}
