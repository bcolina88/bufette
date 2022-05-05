<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    // nombre de la tabla
    protected $table = 'permisos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idrol', 'idmaestro', 'agregar', 'editar', 'ver', 'inhabilitar','borrar'
    ];

    /**
     * Cada permiso pertenece a un rol especifico
     */
    public function rol()
    {
        return $this->belongsTo('App\Model\Role','idrol','id');
    }

    /**
     * Los permisos perteneces a un maestro
     */
    public function maestro()
    {
        return $this->belongsTo('App\Model\Maestro','idmaestro','id');
    }
}
