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
                        <label for="exampleInputPassword1">Fecha</label>  <span style="color: #E6674A;">*</span>
                        <input type="text" class="form-control" name="fecha" id="datepicker_entrada" required>
                    </div>


                    <div class="col-md-6">
                        <br>



                        <div class="bootstrap-timepicker">
			                <div class="form-group">
			                  <label>Hora</label> <span style="color: #E6674A;">*</span>


			                  <div class="input-group">
			                    <input type="text" name="hora" id="hora" class="form-control timepicker">

			                    <div class="input-group-addon">
			                      <i class="fa fa-clock-o"></i>
			                    </div>
			                  </div>
			                  <!-- /.input group -->
			                </div>
			                <!-- /.form group -->
			              </div>
                          
                         <br>
                    </div>



                   <div class="col-md-6">
                      
                       <label for="exampleInputPassword1">Localidad</label>  <span style="color: #E6674A;">*</span>

                      <input type="text" class="form-control" placeholder="Localidad" name="localidad" id="localidad" required >
                   
                    
                       
                    </div>


                    <div class="col-md-6">
                      
                      <label for="exampleInputPassword1">Actor</label> <span style="color: #E6674A;">*</span>
                 
                       {!! Form::text('actor', null, ['class' => 'form-control', 'placeholder' => 'Actor', 'required']) !!}
                      
                    </div>


                    <div class="col-md-6">
                      <br>
                      <label for="exampleInputPassword1">Demandado</label> <span style="color: #E6674A;">*</span>
                 
                       {!! Form::text('demandado', null, ['class' => 'form-control', 'placeholder' => 'Demandado', 'required']) !!}
                      
                    </div>


                    <div class="col-md-6">
                       <br>
                       <label for="exampleInputPassword1">Expediente</label>  <span style="color: #E6674A;">*</span>

                         
                        <select class="form-control select2" id="expediente" name="expediente" required style="width: 100%;">

   
                          <option value="">Seleccione expediente</option>
                           @foreach ($expedientes as $key => $expe)

                          <option value="{{$expe->id}}">{{$expe->numero}}</option>

                          @endforeach



                        </select>
                    
                       <br>
                    </div>

                    @if ($user2)
                    <div class="col-md-6">
                       <br>
                       <label for="exampleInputPassword1">Notificar</label>  

                         
                        <select class="form-control select2" id="notificar" name="notificar" style="width: 100%;">

                          <option value="1">Si</option>
                          <option value="0">No</option>

                        </select>
                    
                       <br>
                    </div>
                    @endif



                    <div class="col-md-12">
                    	<br>
                         <label for="exampleInputPassword1">Señalamiento</label> 

         
                         <textarea id="editor3" name="description" rows="10" cols="80" placeholder="Señalamiento" >
						   @if ($user2)

	                        {{$user2->senalamiento}}

	                        @endif

					    </textarea>

				    </div>


				        <div class="col-md-12">
                       <br><br>
                      <div class="col-md-12" id="ver-image"></div> 

                       <br><br>
       
                       <label for="exampleInputPassword1">Cargar documentos extras</label>

               

                       

                      <input type="file" name="images[]" id="images[]" multiple >
                       

                      
                     
               
                      <br>
                      <span style="color: #E6674A;">*</span> Campos Obligatorios
                      <br><br>
                    </div>



                      





                  </div><!-- /.box-body --> 
                  </div><!-- /.box-body -->
                  </div><!-- /.box-body -->

                  <input type="hidden" name="tipo" id="tipo" value="{{$tipo}}">

                  
                  @if ($user2)

                         <input type="hidden" name="id" id="id" value="{{$user2->id}}">

                   @endif

                  <div class="box-footer">


                   <button id="ingresar" class="btn btn-primary">Guardar</button>
                  </div>
                  </div>
           
              </div><!-- /.box -->
          </div>

@section('javascript')

<script>

   CKEDITOR.replace('editor3')


    $('[data-mask]').inputmask()
    $('.select2').select2();


    $('#datepicker_entrada').val(moment(new Date()).format("DD-MM-YYYY"))
    $('#datepicker_entrada').datetimepicker({
      format: 'DD-MM-YYYY'
    });


    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })




  @if ($user2)


      $('[name="fecha"]').val("{{$user2->fecha}}").trigger('change');
      $('[name="hora"]').val("{{$user2->hora}}").trigger('change');
      $('[name="localidad"]').val("{{$user2->localidad}}").trigger('change');
      $('[name="actor"]').val("{{$user2->actor}}").trigger('change');
      $('[name="demandado"]').val("{{$user2->demandado}}").trigger('change');
      $('[name="expediente"]').val("{{$user2->idexpediente}}").trigger('change');
      $('[name="notificar"]').val("{{$user2->notificar}}").trigger('change');



      var images = "{{$user2->documentos}}";
      var ruta = "{{$ruta}}";
      
      var dd = images.split(",");
      var h,text="";

      for (var i = 0; i < dd.length - 1; i++) {

      	h = i+1;


      	text+="<a href='"+ruta+"/"+dd[i]+"' target='_blank'> <div class='col-md-3 col-sm-4'><i class='fa fa-fw fa-file-pdf-o'></i> Documento"+h+"</div></a>";
  
      };


      $('#ver-image').html(text);

     





  @endif


$('#ingresar').click(function(){



        if (( $('[name="fecha"]').val() ==="") ||  ($('[name="expediente"]').val() ==="")||  ($('[name="hora"]').val() ==="")||  ($('[name="actor"]').val() ==="")||  ($('[name="demandado"]').val() ==="")||  ($('[name="localidad"]').val() ==="")) {
    




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


	   
      var data = getFiles();
      data=getFormData("formCreate",data);


      $.ajax({
          url: "{{ route('audiencias.store') }}",                                          
          data: data,
          contentType: false,
          processData: false,
          method: 'POST',
      })
      .done(function(msg) {

        if (msg === "guardar") {
          var message = 'La Audiencia Fue Creada Correctamente';

        };

        if (msg === "editar") {
          var message = 'La Audiencia Fue Actualizada Correctamente';

        };

          window.location.href = "{{ route('audiencias.index') }}";

      })
      .fail(function(msg) {
            //console.log("error en createAlbarane");
      });



}



function getFiles(){

  var idFiles=document.getElementById("images");
  var archivos=$("#images")[0].files;
  var data=new FormData();


  for (var i = 0; i < archivos.length; i++) {
    data.append("images[]",archivos[i])
  };


  return data;

}

function getFormData(id,data){

  $("#"+id).find("input,select").each(function(i, v) {
      if (v.type!=="file") {
       

          if (v.type==="checkbox"){

              if(v.checked===false) {
                 data.append(v.name,"off");
              }

              if(v.checked===true) {
                 data.append(v.name,"on");
              }

             
          }else{


            if (v.type==="radio"){

                if(v.checked===true) {
                   data.append(v.name,v.value);
                }
               
            }else{
              data.append(v.name,v.value);
            }

          }

      };
  });


   var text1 = CKEDITOR.instances['editor3'].getData();


   data.append("expediente",$('[name="expediente"]').val());
   data.append("description",text1);
   data.append("tipo","{{$tipo}}");

   @if ($user2)
     data.append("id","{{$user2->id}}");
    @endif




  return data;

}



</script>
@endsection
