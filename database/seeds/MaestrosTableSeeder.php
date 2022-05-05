<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class MaestrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      DB::table('maestros')
          ->insert([
          			[ 'titulo' => 'Escritorio', 'idpadre' => 1, 'ruta' => 'home', 'tipo' => 'ver'],
                    [ 'titulo' => 'Expedientes', 'idpadre' => 2, 'ruta' => 'expedientes', 'tipo' => 'ver'],
                    [ 'titulo' => 'Escritos', 'idpadre' => 3, 'ruta' => 'escritos', 'tipo' => 'ver'],
                    [ 'titulo' => 'Casos', 'idpadre' => 4, 'ruta' => 'casos', 'tipo' => 'ver'],
                    [ 'titulo' => 'Audiencias', 'idpadre' => 5, 'ruta' => 'audiencias', 'tipo' => 'ver'],
                    [ 'titulo' => 'Configuracion', 'idpadre' => 6, 'ruta' => '', 'tipo' => 'ver'],
                    [ 'titulo' => 'Usuarios', 'idpadre' => 7, 'ruta' => 'usuarios', 'tipo' => 'agregar'],
                    [ 'titulo' => 'Roles', 'idpadre' => 8, 'ruta' => 'roles', 'tipo' => 'ver'],
                    [ 'titulo' => 'Reset/Password', 'idpadre' => 9, 'ruta' => 'resetPassword', 'tipo' => 'ver'],
       
                 
                ]);
    }
}
