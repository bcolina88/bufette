<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    // nombre de la tabla
    protected $table = 'maestros';

    /**
     * Un maestro puede ser una subseccion, por lo que puede tener un maestro padre
     */

    protected $fillable = [
        'idpadre', 'titulo', 'ruta'
    ];

    public function padre()
    {
        return $this->belongsTo('App\Model\Maestro', 'idpadre', 'id');
    }
}
