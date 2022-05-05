<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('domicilio');
            $table->string('departamento')->nullable();
            $table->string('ciudad');
            $table->string('estado');
            $table->string('telefono')->nullable();;
            $table->string('codigo_postal')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('seguro_social')->nullable();;
            $table->string('contacto_emergencia')->nullable();
            $table->text('images');


            $table->boolean('active');
            $table->integer('idrole')->unsigned();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('idrole')->references('id')->on('roles')
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
        Schema::dropIfExists('users');
    }
}
