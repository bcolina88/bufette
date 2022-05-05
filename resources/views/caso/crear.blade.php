@extends('layout.template')
@section('title')
Crear Caso | Bufette H&M Legal.
@endsection


@section('content')
  <section class="content-header">
      <h1>
        Crear Caso</h1>
        <small></small>
    </section>


{!! Form::open(['route'=>'casos.store','enctype'=>'multipart/form-data','method'=>'POST','files'=>'true','accept-charset'=>'UTF-8']) !!}

@include('caso.forms.caso') 

{!! Form::close() !!}


@stop