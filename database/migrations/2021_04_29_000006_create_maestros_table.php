<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('ruta');
            $table->string('tipo');
            $table->integer('idpadre')->unsigned()->index();
            $table->timestamps();

            $table->foreign('idpadre')->references('id')->on('maestros')
            ->onUpdate('cascade')
            ->onDetete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maestros');
    }
}
