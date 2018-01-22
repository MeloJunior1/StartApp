<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('cnpj', 20)->unique();
            $table->string('telefone', 20);
            $table->string('cep', 15);
            $table->string('cidade', 100);
            $table->string('uf', 2);

            $table->integer('dono')->unsigned();
            $table->foreign('dono')->references('id')->on("users");

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
        Schema::dropIfExists('restaurants');
    }
}
