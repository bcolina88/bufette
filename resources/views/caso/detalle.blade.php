@extends('layout.template')
@section('title')
Detalle de Usuario | Steades
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
                        <span class="widget-user-username" style="font-size: 40px"> <b>{{$users->apellido}}, {{$users->nombre}} {{$users->segundo_nombre}} </b></span>
                        <br><br>
                      </div>

                        <p><b>Dirección</b></p>
                        <p>{{$users->domicilio}}</p>
                        <br>

                        <div class="pull-left">
                          <p><b>SSN</b></p>
                          <p>*****{{$ssn}}</p>
                        </div>

                        <div class="pull-right">
                          <p><b>F. contrato</b></p>
                          <p>{{$users->fecha_contrato}}</p>
                        </div>


                        <br><br><br>


                      </div>



                  </div>


                  <!-- ./col -->

                  <!-- ./col -->

           @if ($ultimo_pay)

            <div class="box">
                  <div class="col-md-1"></div>
                  <div class="col-md-5" style="text-align:center">
                      <h3 class="widget-user-username" style="text-align:center"> Último Pago</h3>
                      <h5 class="widget-user-username" style="text-align:center"> realizado el {{date_format($ultimo_pay->created_at, 'Y-m-d')}}</h5>

                      <div class="inner"  style="text-align:center">
                        <h1 style="text-align:center">$ {{number_format($ultimo_pay->monto, 2, ',' , '.' )}} </h1>
                        <br>
                      </div>
                  </div>
                  <div class="col-md-5" style="padding-top:60px">

                    <a class="btn btn-block btn-info" href="{{route("reciboPago", ["id" => $ultimo_pay->id])}}" >Ver pago <i class="fa fa-fw fa-file-pdf-o"></i></a>
                 </div>
                 <div class="col-md-1"></div>


            </div>

             @endif
             <div class="row">

                <div class="col-xs-12 table-responsive">
                  <table class="table table-striped">
                    <h3 class="widget-user-username"> Pagos Recientes</h3>
                    <thead>
                    <tr>
                      <th>Período de trabajo</th>

                      <th>Monto</th>
                      <th>Fecha de realización</th>
                      <th>Realizado por</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>


                    @forelse ($movements as $key => $movement)
                  <tr>


                    <td>{{$movement->fecha_inicio}} / {{$movement->fecha_fin}}</td>

                    <td>$ {{number_format($movement->monto, 2, ',' , '.' )}} </td>
                    <td>{{date_format($movement->created_at, 'Y-m-d')}}</td>
                    <td>{{$movement->transcriptor->nombre}} {{$movement->transcriptor->apellido}}</td>
                    <td><a href="{{route("reciboPago", ["id" => $movement->id])}}" class="btn btn-default btn-info fa fa-file-pdf-o" ></a> </td>
                    <td>




                    </td>
                     <td>
                      <div class="btn-group">





                      </div>
                    </td>
                  </tr>
                    @empty

                        No hay pagos que mostrar
                    @endforelse


                  </tbody>

                </table>

                </div>
                <!-- /.col -->
              </div>


            <div class="col-md-12">
               <hr>
              <img src="../../dist/img/credit/visa.png" alt="Visa">
              <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
              <img src="../../dist/img/credit/american-express.png" alt="American Express">
              <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
              <br><br><br>

            </div>
          <!-- /.widget-user -->
        </div>


     

       
        <div class="box-body">

            @if ((Auth::user()->idrole != 3)&&(Auth::user()->idrole != 4))


            <a href="{{route('usuarios.index')}}" class="btn btn-default  btn-flat pull-left"><b>Regresar listado de usuarios</b></a>
            <a href="{{route('equipo')}}" class="btn btn-default  btn-flat pull-right"><b>Regresar equipo de nómina</b></a>
            
            @endif

        </div>
       


  


</section>

</section>


@stop