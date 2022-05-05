@extends('layout.template')
@section('title')
Cambiar Contraseña | Bufette H&M Legal.
@endsection
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <br><br><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">Cambiar Contraseña </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('resetPass') }}">
                        {{ csrf_field() }}

                

                        <input type="hidden" name="token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" disabled="true" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña </label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="confirmation" required>

                                @if ($errors->has('confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cambiar Contraseña 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="advertencia" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-body" >


      



            <br><br><br><br>
            <div class="swal-title">El Password fue cambiando con exito.</div>
            <div style="text-align: center;font-size: 16px;" >Debe salir del sistema y usar su nuevo password.</div>
            <br><br><br><br>
        </div>
        <div class="modal-footer">

           <a class="btn btn-primary" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
               
                    <span class="s-text" style="font-size: 14px;">Salir</span>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
          </a>



   
        </div>
      </div>
    </div>
  </div>




<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
  

@section('javascript')
<script>


$(function () {

    @if ($change)



          $('#advertencia').modal('toggle'); 



      /*  swal({
              title: 'El Password fue cambiando con exito.',
              text: "Debe salir del sistema y usar su nuevo password.",
              
              icon: 'warning',
              buttons: {
                confirm: {
                  text: "Salir",
                  value: true,
                  visible: true
                }
              }
            }).then((result) => {
              if (result) {
                window.location.href = "{{ route('logout') }}";

                //var vv =  $('[name="_token"]').val();

                //console.log


               // var url = '{{ route("logout", ":slug") }}';
               // url = url.replace(':slug',vv);
               // window.location.href=url;



                
              }
            });*/





        
    @endif


    @if ($errorr === "true")



        swal({
              title: 'No coinciden Password y Confirm',
              
              icon: 'warning',
              buttons: {
    
                cancel: {
                  text: "Salir",
                  value: false,
                  visible: true
                }
              }
            }).then((result) => {});



        
    @endif


    



});

</script>
   
@endsection




@endsection
