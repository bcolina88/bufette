@extends('layout.template')
@section('title')
Editar Escrito | Bufette H&M Legal.
@endsection
@section('content')

  <section class="content-header">
      <h1>
        Editar Escrito
        <small></small>
    </section>


{!! Form::model($user2, ['route'=>['escritos.store', $user2->id], 'method'=>'POST','enctype'=>'multipart/form-data','files'=>'true','accept-charset'=>'UTF-8']) !!}


@include('escrito.forms.escrito')


{!! Form::close() !!}


@stop