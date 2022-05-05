@extends('layout.template')
@section('title')
Editar Audiencia | Bufette H&M Legal.
@endsection
@section('content')

  <section class="content-header">
      <h1>
        Editar Audiencia
        <small></small>
    </section>

{!! Form::model($user2, ['route'=>['audiencias.store', $user2->id], 'method'=>'POST','enctype'=>'multipart/form-data','files'=>'true','accept-charset'=>'UTF-8']) !!}


@include('audiencia.forms.audiencia')

{!! Form::close() !!}



@stop