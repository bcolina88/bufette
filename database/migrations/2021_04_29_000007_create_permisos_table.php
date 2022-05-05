<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idrol')->unsigned()->index();
            $table->integer('idmaestro')->unsigned()->index();
            $table->integer('agregar')->unsigned();
            $table->integer('editar')->unsigned();
            $table->integer('ver')->unsigned();
            $table->integer('inhabilitar')->unsigned();
            $table->integer('borrar')->unsigned();
            $table->timestamps();

            $table->foreign('idrol')->references('id')->on('roles')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('idmaestro')->references('id')->on('maestros')
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
        Schema::drop('permisos');
    }
}
