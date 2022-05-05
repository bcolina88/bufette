@extends('layout.template')
@section('title')
Crear usuario | Bufette H&M Legal.
@endsection


@section('content')
  <section class="content-header">
      <h1>
        Crear Usuario</h1>
        <small></small>
    </section>



 {!! Form::open(['route'=>'usuarios.store','enctype'=>'multipart/form-data','method'=>'POST','files'=>'true','accept-charset'=>'UTF-8']) !!}


@include('usuario.forms.user') 

{!! Form::close() !!}

@stop