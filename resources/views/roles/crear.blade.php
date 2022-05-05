@extends('layout.template')
@section('title')
Crear rol | Bufette H&M Legal.
@endsection


@section('content')
  <section class="content-header">
      <h1>
        Crear Rol
        <small></small>
    </section>



@include('roles.forms.role') 




@stop