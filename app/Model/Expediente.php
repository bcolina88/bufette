<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'numero','fecha_entrada','fecha_estado','estado','proceso'
    ];



 

}
