<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
   

   protected $table = 'notificaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'fecha', 'hora','localidad','idaudiencia','visto'
    ];



    

}
