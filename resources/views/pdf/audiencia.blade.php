@extends('layout')
@section('css')
  <style media="screen">

    .pull-left {
        float: left !important;
    }

    .pull-right {
        float: right !important;
    }


    .table>tbody>tr>td {
        border-top: 1px solid #fff;
    }

    .table>thead>tr>th {
        border-bottom: 2px solid #fff;
    }

    .table>tbody>tr>th {
        border-bottom: 2px solid #fff;
    }


}

  </style>
@endsection

@section('content')

    <div class="col-md-12" style="font-size: 10px;line-height: 0.5">
        <div class="">
            
            <br><br><br>
            <p><b>EXPEDIENTE: {{$audiencia->expediente->numero}}</b></p>
            <p><b>ACTOR: {{$audiencia->actor}}</b></p>
            <p><b>DEMANDADO: {{$audiencia->demandado}}</b></p>
            <p><b>PROCESO: {{$audiencia->expediente->proceso}}</b></p>
            <p><b>FECHA: {{$audiencia->fecha}}</b></p>
            <p><b>HORA: {{$audiencia->hora}}</b></p>
            <p><b>LOCALIDAD: {{$audiencia->localidad}}</b></p>
            
        </div>


    </div>

   

                        

    
@endsection