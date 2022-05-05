@extends('layout.template')
@section('title')
Detalle de usuario | Bufette H&M Legal.
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
                        <span class="widget-user-username" style="font-size: 40px"> <b>{{$users->nombre}} {{$users->apellido}} </b></span>
                        
                        <p class="widget-user-username" style="font-size: 18px"> <b>{{$users->domicilio}} {{$users->apellido}} </b></p>
                        <br><br>
                      </div>

                      

                        <div>
                          <div class="pull-left">
                            <p><b>Fecha de Nacimiento</b></p>
                            <p>

                              @if($users->fecha_nacimiento == null) 
                                  N/D
                              @else
                                 {{$users->fecha_nacimiento}} 
                              @endif


                            </p>

                            <p><b>Telefono</b></p>
                              <p>
                                @if($users->telefono == null) 
                                  N/D
                              @else
                                 {{$users->telefono}} 
                              @endif

                             </p>

                              <p><b>Departamento</b></p>
                            <p>

                              @if($users->departamento == null) 
                                  N/D
                              @else
                                 {{$users->departamento}} 
                              @endif


                            </p>
                          </div>

                          <div class="pull-right">
                            <p><b>Codigo postal</b></p>
                            <p>

                        
                               @if($users->codigo_postal == null) 
                                  N/D
                              @else
                                 {{$users->codigo_postal}} 
                              @endif

                           </p>

                            <p><b>Seguro Social</b></p>
                            <p>

                      
                               @if($users->seguro_social == null) 
                                  N/D
                              @else
                                 {{$users->seguro_social}} 
                              @endif

                           </p>

                            <p><b>Ciudad</b></p>
                            <p>

                             @if($users->ciudad == null) 
                                  N/D
                              @else
                                 {{$users->ciudad}} 
                              @endif

                           </p>
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

            <a href="{{route('usuarios.index')}}" class="btn btn-default  btn-flat pull-right"><b>Regresar listado de usuarios</b></a>
     
        </div>
       


  


</section>

</section>


@stop