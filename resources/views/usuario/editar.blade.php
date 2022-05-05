@extends('layout.template')
@section('title')
Editar Usuario | Bufette H&M Legal.
@endsection
@section('content')

  <section class="content-header">
      <h1>
        Editar Usuario
        <small></small>
    </section>



{!! Form::model($user2, ['route'=>['usuarios.update', $user2->id], 'method'=>'PUT','enctype'=>'multipart/form-data','files'=>'true','accept-charset'=>'UTF-8']) !!}


@include('usuario.forms.user')


{!! Form::close() !!}

@stop