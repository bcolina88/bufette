@extends('layout.template')
@section('title')
Detalle de Usuario | Bufette H&M Legal.
@endsection
@section('content')


  <section class="content">
    <!-- Main content -->
    <section class="invoice">
    	    <!-- title row -->
          @if (Session::has('message'))
 <p class="alert alert-info"><b>{{ Session::get('message')}}</b></p>
@endif
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-user"> {{$users->apodo}} {{$users->nombre}} {{$users->apellido}}</i> 
            <small class="pull-right">Creado: {{date_format($users->created_at, 'd/m/y')}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">

          <address>
          <b>Nombre Completo:</b> {{$users->nombre}} {{$users->apellido}}
          <br>
          <b>Cargo:</b> {{$users->cargo}}<br>
          
          <b>Empresa:</b> {{$users->compania->name_company}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          <address>
          <b>Tipo de Usuario:</b> {{$users->tipe->tipo}}<br>
          <b>E-mail:</b> {{$users->email}}<br>
          </address>
        </div>
        <!-- /.col -->
</div>

            <div class="box-body">
	
              {!! Form::model($users, ['route'=>['usuarios.update', $users->id], 'method'=>'DELETE']) !!}

              <button type='submit' class="btn btn-default btn-danger btn-flat pull-right" onclick="return confirm('Seguro que Desea eliminar a {{$users->nombre}}')" ><i class="fa fa-trash"></i>Eliminar</button>
            {!! Form::close() !!}

              <a href="{{route('usuarios.index')}}" class="btn btn-default btn-success btn-flat pull-right"><b>Regresar</b></a>
              <a href="{{route("usuarios.edit", ['id' => $users->id])}}" onclick="return confirm('Seguro que Desea Editar a {{$users->nombre}}')" class="btn btn-default btn-warning btn-flat pull-right"><b>Editar</b></a>
</div>

	<div class="col-sm-4 invoice-col">
</div>
</section>




</section>


@stop