@extends('layout.template')
@section('title')
Editar Caso | Bufette H&M Legal.
@endsection
@section('content')

  <section class="content-header">
      <h1>
        Editar Caso
        <small></small>
    </section>

{!! Form::model($user2, ['route'=>['casos.store', $user2->id], 'method'=>'POST','enctype'=>'multipart/form-data','files'=>'true','accept-charset'=>'UTF-8']) !!}

@include('caso.forms.caso')

{!! Form::close() !!}


@stop