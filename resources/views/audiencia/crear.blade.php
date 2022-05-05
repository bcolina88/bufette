@extends('layout.template')
@section('title')
Crear Audiencia | Bufette H&M Legal.
@endsection


@section('content')
  <section class="content-header">
      <h1>
        Crear Audiencia</h1>
        <small></small>
    </section>



{!! Form::open(['route'=>'audiencias.store','enctype'=>'multipart/form-data','method'=>'POST','files'=>'true','accept-charset'=>'UTF-8']) !!}
 
@include('audiencia.forms.audiencia') 

{!! Form::close() !!}


@stop