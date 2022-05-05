<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'proceso', 'descripcion','idexpediente','documentos'
    ];



    public function expediente()
    {

        return $this->belongsTo('App\Model\Expediente','idexpediente','id');
    }

}
