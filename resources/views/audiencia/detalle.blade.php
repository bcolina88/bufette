@extends('layout.template')
@section('title')
Detalle de Audiencia | Bufette H&M Legal.
@endsection
@section('content')


  <section class="content">
    <!-- Main content -->
    <section class="invoice">
    	    <!-- title row -->
            @if (Session::has('message'))
			 <p class="alert alert-info"><b>{{ Session::get('message')}}</b></p>
			@endif


       <div class="col-md-12">
          <!-- Widget: user widget style 1 -->



                  <!-- ./col -->
                  <div class="col-md-12 small-box bg-aqua">
                    <!-- small box -->

                      <div class="inner">
                         <div class="widget-user-header bg-aqua">
                        <!--<div class="widget-user-image image">
                          <img class="img-circle responsive" src="../dist/img/Sin_foto.png" alt="User Avatar">
                        </div>-->
                        <br><br><br><br>
                        <!-- /.widget-user-image -->
                        <span class="widget-user-username" style="font-size: 40px"> <b>Expediente: {{$audiencia->expediente->numero}} </b></span>
                        <br><br>
                      </div>

                        <br><br><br>

                        <div>
	                        <div class="pull-left">
	                          <p><b>Fecha</b></p>
	                          <p>{{$audiencia->fecha}} </p>

	                          <p><b>Actor</b></p>
                              <p>{{$audiencia->actor}} </p>

                              <p><b>Proceso</b></p>
	                          <p>{{$audiencia->expediente->proceso}} </p>
	                        </div>

	                        <div class="pull-right">
	                          <p><b>Hora</b></p>
	                          <p>{{$audiencia->hora}} </p>

	                          <p><b>Demandado</b></p>
                              <p>{{$audiencia->demandado}} </p>

                              <p><b>Localidad</b></p>
                              <p>{{$audiencia->localidad}} </p>
	                        </div>


	                       
                        </div>

       


                        <br><br><br>


                      </div>



                  </div>


                  <!-- ./col -->

                  <!-- ./col -->

           
          <!-- /.widget-user -->
        </div>


     

       
        <div class="box-body">

            <a href="{{route('audiencias.index')}}" class="btn btn-default  btn-flat pull-right"><b>Regresar listado de audiencias</b></a>
     
        </div>
       


  


</section>

</section>


@stop