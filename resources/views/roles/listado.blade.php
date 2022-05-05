@extends('layout.template')
@section('title')
Listado de roles | Bufette H&M Legal.
@endsection
@section('content')


    <!-- Main content -->
  <section class="content">

            <!-- TABLE: LATEST ORDERS -->
          <div class="box box-success">
            <div class="box-header with-border">

              <h3 class="box-title">Listado de roles</h3>
@if (Session::has('message'))
 <p class="alert alert-info"><b>{{ Session::get('message')}}</b></p>
@endif
  {!!Form::open(['route'=>'roles.index', 'method'=>'GET'])!!}
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
                    <th>Nro</th>
                    <th>Nombre</th>
              
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($roles as $boxe)
                  <tr>

                    <td>{{$boxe->id}}</td>
                    <td>{{$boxe->tipo}}</td>
            
            
                     <td>
                      <div class="btn-group">
               {!! Form::model($boxe, ['route'=>['roles.update', $boxe->id], 'method'=>'DELETE']) !!}

  
              <a href="{{route("roles.edit", ['id' => $boxe->id])}}" onclick="return confirm('Seguro que Desea Editar a rol {{$boxe->tipo}}')" class="btn btn-default btn-warning fa fa-pencil"><b></b></a> 

              @if (Auth::user()->idusertype != 2)
              <button type='submit' class="btn btn-default btn-danger fa fa-trash" onclick="return confirm('Seguro que Desea eliminar a rol {{$boxe->tipo}}')" ></i></button> @endif
            {!! Form::close() !!}

             


              </div>
                    </td>
                  </tr>
                     @empty

                  No hay Datos que Motrar.
                    @endforelse


                  </tbody>

                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             <a href="{{route('roles.create')}}" class="btn btn-default btn-warning btn-flat pull-left"><b>Nuevo rol</b></a> 
              <ul class="pagination pagination-sm no-margin pull-right">
                {{ $roles->links() }}
              </ul>

            </div>

            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

  </section>


@stop