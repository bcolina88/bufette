@extends('layout.template')
@section('title')
Listado de Expedientes | Bufette H&M Legal.
@endsection
@section('content')

  <section class="content-header">
      <h1>
        Listado de Expedientes
        <small></small>
    </section>


    <!-- Main content -->
  <section class="content">

            <!-- TABLE: LATEST ORDERS -->
          <div class="box box-success">
            <div class="box-header with-border">

            <br>
            @if (Session::has('message'))
             <p class="alert alert-info"><b>{{ Session::get('message')}}</b></p>
            @endif

            {!!Form::open(['route'=>'expedientes.index', 'method'=>'GET'])!!}
            <div class="input-group">

                      <input type="text" name="search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Buscar..."/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>

            </div>
            {!!Form::close()!!}
 
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin table-striped  table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Numero</th>
                    <th>Fecha Entrada</th>
                    <th>Fecha Estado</th>
                    <th>Proceso</th>
                    <th>Estado</th>
                    @if (Auth::user()->idrole != 3)
                    <th>Acciones</th>
                      @endif  
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($orders as $key => $user)
                  <tr>

                  
                    <td>{{$user->id}}</td>
                    <td>{{$user->numero}}</td>
                    <td>{{$user->fecha_entrada }}</td>
                    <td>{{$user->fecha_estado }}</td>
                    <td>{{$user->proceso }}</td>
  
                    <td>{{$user->estado}}</td>
 
                     
                     <td>
                    
                      <div class="btn-group">
          
                          {!! Form::model($user, ['route'=>['expedientes.update', $user->id], 'method'=>'DELETE']) !!}

                          <a href="{{route("expedientes.show", ['id' => $user->id])}}" class="btn btn-default btn-success fa fa-search"><b></b></a> 
                          
                          @if (\App\Http\Controllers\RolesController::editar(3))
                          <a href="{{route("expedientes.edit", ['id' => $user->id])}}" onclick="return confirm('Seguro que Desea Editar a el Expediente Nº {{$user->numero}}')" class="btn btn-default btn-warning fa fa-pencil"><b></b></a> 
                          @endif


                          @if (\App\Http\Controllers\RolesController::borrar(3))

                          <button type='submit' class="btn btn-default btn-danger fa fa-trash" onclick="return confirm('Seguro que Desea eliminar a el Expediente Nº {{$user->numero}}')" ></i></button>
                          
                          @endif

                          {!! Form::close() !!}

                      </div>
                                    
                      </td>
                     
                  </tr>
                     @empty

                  No hay Datos que Mostrar.
                    @endforelse


                  </tbody>

                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

              @if (\App\Http\Controllers\RolesController::agregar(3))
                <a href="{{route('expedientes.create')}}" class="btn btn-default btn-warning btn-flat pull-left"><b>Nuevo Expediente</b></a> 
              @endif

              <ul class="pagination pagination-sm no-margin pull-right">
                {{ $orders->links() }}
              </ul>

            </div>

            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

  </section>


@stop