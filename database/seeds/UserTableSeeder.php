<?php
use App\Model\User;

use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
       'nombre' => 'David',
       'apellido' => 'Cruz Salablanca',
       'idrole'  => 1,
       'active'  => true,
       'email' => 'david_cruz29@hotmail.com',
       'password' => bcrypt('secret'),
       'seguro_social'=>'000-00-0000',
       'domicilio' => '',
       'departamento' => '',
       'ciudad'=> '',
       'estado'=> '',
       'codigo_postal'=> '',
       'fecha_nacimiento'=> '',
       'seguro_social'=> '',
       'telefono'=> '',
       'contacto_emergencia' => '',
       'images'=> '',


       ]);
   

    }
}
