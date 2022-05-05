<?php

namespace App\Observers;

use App\Model\Audiencia;
use App\Model\Notificacion;

class AudienciaObserver
{
    /**
     * Handle the audiencia "created" event.
     *
     * @param  \App\Audiencia  $audiencia
     * @return void
     */
    public function created(Audiencia $audiencia)
    {
        //


        $dia_siguiente = date("d-m-Y", strtotime("+1 day"));


        if($dia_siguiente == $audiencia->fecha){

        	$notificacion = Notificacion::firstOrCreate([
              		'idaudiencia'  => $audiencia->id,
                    'fecha'        => $audiencia->fecha,
                    'hora'         => $audiencia->hora,
                    'localidad'    => $audiencia->localidad,
                    'visto'        => 0,

            ]);

            $notificacion->save();
        }
    }

    /**
     * Handle the audiencia "updated" event.
     *
     * @param  \App\Audiencia  $audiencia
     * @return void
     */
    public function updated(Audiencia $audiencia)
    {
        //

        $dia_siguiente = date("d-m-Y", strtotime("+1 day"));


       // if($dia_siguiente == $audiencia->fecha){

        	$notificacion = Notificacion::firstOrCreate([
              		'idaudiencia'  => $audiencia->id,
                    'fecha'        => $audiencia->fecha,
                    'hora'         => $dia_siguiente,
                    'localidad'    => $audiencia->localidad,
                    'visto'        => 0,


            ]);

            $notificacion->save();
        //}
    }

    /**
     * Handle the audiencia "deleted" event.
     *
     * @param  \App\Audiencia  $audiencia
     * @return void
     */
    public function deleted(Audiencia $audiencia)
    {
        //
    }

    /**
     * Handle the audiencia "restored" event.
     *
     * @param  \App\Audiencia  $audiencia
     * @return void
     */
    public function restored(Audiencia $audiencia)
    {
        //
    }

    /**
     * Handle the audiencia "force deleted" event.
     *
     * @param  \App\Audiencia  $audiencia
     * @return void
     */
    public function forceDeleted(Audiencia $audiencia)
    {
        //
    }
}
