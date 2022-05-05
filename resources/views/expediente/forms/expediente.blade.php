<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header">
         
                       <div class="row">
<div class="col-md-9">
  @if ($errors->any())
    <ul>
    <div class="alert alert-warning">
  <b>Corrige Los Siguientes Errores:</b>
  @foreach ($errors->all() as $error)
  <li>
  {{$error}}
</li>
@endforeach
</div>
</ul>

@endif
</div>
</div>
                </div><!-- /.box-header -->
                <!-- form start -->               
             
                  <div class="box-body">
                    <div class="col-md-12">
                    <div class="form-group">
                      
                    <div class="col-md-6">
                      <br>
                      <label for="exampleInputPassword1">Numero</label> <span style="color: #E6674A;">*</span>
                 
                     {!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'required']) !!}
                    </div>

            


                    <div class="col-md-6">
                        <br>
                        <label for="exampleInputPassword1">Fecha de entrada</label>  <span style="color: #E6674A;">*</span>
                        <input type="text" class="form-control" name="fecha_entrada" id="datepicker_entrada" required>
                    </div>


                    <div class="col-md-6">
                        <br>
                        <label for="exampleInputPassword1">Fecha de estado</label>  <span style="color: #E6674A;">*</span>
                        <input type="text" class="form-control" name="fecha_estado" id="datepicker_estado" required>
                         <br>
                    </div>





                    

                    <div class="col-md-6">
                      <br>
                      <label for="exampleInputPassword1">Proceso</label> <span style="color: #E6674A;">*</span>
                 
                
                       {!! Form::text('proceso', null, ['class' => 'form-control', 'placeholder' => 'Proceso', 'required']) !!}
                   



                    </div>



                    @if ($user2)

                    <div class="col-md-6">
                              <br>
                            <label for="exampleInputPassword1">Estado</label> 
    
                              <select class="form-control select2" id="estado" name="estado" style="width: 100%;">
                                <option value="">Seleccione estado</option>
                                <option value="Iniciado">Iniciado</option>
                                <option value="Con señalamiento audiencia">Con señalamiento audiencia</option>
                                <option value="Prevención">Prevención</option>
                                <option value="Rechazado">Rechazado</option>
                                <option value="Terminado">Terminado</option>
                     
                              </select>
                               
                              
                    </div>

                    @endif



        


                  </div><!-- /.box-body --> 
                  </div><!-- /.box-body -->
                  </div><!-- /.box-body -->

                  <input type="hidden" name="tipo" id="tipo" value="{{$tipo}}">

                
                  <div class="box-footer">

                  	
                   <button id="ingresar" class="btn btn-primary">Guardar</button>
                  </div>
                  </div>
           
              </div><!-- /.box -->
          </div>

@section('javascript')
<script>


  $('[data-mask]').inputmask()
  $('.select2').select2();


    $('#datepicker_entrada').val(moment(new Date()).format("DD-MM-YYYY"))
    $('#datepicker_entrada').datetimepicker({
      format: 'DD-MM-YYYY'
    });

    $('#datepicker_estado').val(moment(new Date()).format("DD-MM-YYYY"))
    $('#datepicker_estado').datetimepicker({
      format: 'DD-MM-YYYY'
    });




  @if ($user2)
      $('[name="numero"]').val("{{$user2->numero}}").trigger('change');
      $('[name="fecha_estado"]').val("{{$user2->fecha_estado}}").trigger('change');
      $('[name="fecha_entrada"]').val("{{$user2->fecha_entrada}}").trigger('change');
      $('[name="proceso"]').val("{{$user2->proceso}}").trigger('change');

      $("#estado").val("{{$user2->estado}}").trigger('change');


  @endif


$('#ingresar').click(function(){



         if (( $('[name="numero"]').val() ==="") ||  ($('[name="fecha_entrada"]').val() ==="")|| ($('[name="fecha_estado"]').val() ==="")|| ($('[name="proceso"]').val() ==="")) {
    


            swal({
              title: 'Verifique los campos obligatorios',
              
              icon: 'warning',
              buttons: {
    
                cancel: {
                  text: "Salir",
                  value: false,
                  visible: true
                }
              }
            });






        }else{
                agregarOrden(); 
        };


  


});



function agregarOrden(){

        var id ="";
        var estado ="";

        @if ($user2)
           id ="{{$user2->id}}";
           estado = $('[name="estado"]').val();
        @endif
  



      $.ajax({
        url: "{{ route('expedientes.store') }}",
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({ 
            "_token":         "{{ csrf_token() }}",
            "numero":          $('[name="numero"]').val(),
            "fecha_estado":    $('[name="fecha_estado"]').val(),
            "fecha_entrada":   $('[name="fecha_entrada"]').val(),
            "proceso":         $('[name="proceso"]').val(),
            "id":              id,
            "estado":          estado,
            "tipo":            "{{$tipo}}"
        })
      })       
      .done(function(msg) {

        if (msg === "creado") {
          var message = 'El Expediente Fue Creado Correctamente';

        };

        if (msg === "editar") {
          var message = 'El Expediente Fue Actualizado Correctamente';

        };

         window.location.href = "{{ route('expedientes.index') }}";


      })
      .fail(function(msg) {
      });



}


</script>
@endsection
