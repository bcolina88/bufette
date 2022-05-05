@extends('layout.template')
@section('title')
Crear Escrito | Bufette H&M Legal.
@endsection


@section('content')
  <section class="content-header">
      <h1>
        Crear Escrito</h1>
        <small></small>
    </section>



{!! Form::open(['route'=>'escritos.store','enctype'=>'multipart/form-data','method'=>'POST','files'=>'true','accept-charset'=>'UTF-8']) !!}

@include('escrito.forms.escrito') 

{!! Form::close() !!}

@stop