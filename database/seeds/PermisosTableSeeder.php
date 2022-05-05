<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permisos')
          ->insert([
            [ 'idrol' => 1,
              'idmaestro' => 1,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],

            [ 'idrol' => 1,
              'idmaestro' => 2,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],

            [ 'idrol' => 1,
              'idmaestro' => 3,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],

            [ 'idrol' => 1,
              'idmaestro' => 4,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],

            [ 'idrol' => 1,
              'idmaestro' => 5,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],

            [ 'idrol' => 1,
              'idmaestro' => 6,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],


               [ 'idrol' => 1,
              'idmaestro' => 7,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],

               [ 'idrol' => 1,
              'idmaestro' => 8,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],

               [ 'idrol' => 1,
              'idmaestro' => 9,
              'agregar' => 1,
              'editar' => 1,
              'ver' => 1,
              'inhabilitar' => 1,
              'borrar' => 1],



          ]);
    }
}
