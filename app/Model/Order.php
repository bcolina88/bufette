<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'letra','numero','fechacreacion' ,'nombre' ,'telefono','apellido','email','marca','modelo', 'serie','lapiz',
        'garantia','clavebloqueo', 'diagnostico', 'valor', 'detalle', 'bateria' ,'tapa', 'memoria' ,'sim' ,'idatendidopor', 'visitas', 'estado', 'confirmado'
    ];



    public function atendidopor()
    {

        return $this->belongsTo('App\Model\User','idatendidopor','id');
    }

}
