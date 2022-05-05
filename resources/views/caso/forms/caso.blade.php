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
                <form role="form">
             	
                  <div class="box-body">
                    <div class="col-md-12">
                    <div class="form-group">



                    <div class="col-md-6">
                      <br>
                      <label for="exampleInputPassword1">Proceso</label> <span style="color: #E6674A;">*</span>
                 
                       {!! Form::text('proceso', null, ['class' => 'form-control', 'placeholder' => 'Proceso', 'required']) !!}
                      
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
                    
                       
                    </div>


     

                    <div class="col-md-12">
                    	<br>
                         <label for="exampleInputPassword1">Descripción</label> 

                        <textarea id="editor2" name="description" rows="10" cols="80" placeholder="Descripción Corta" >
					    @if ($user2)

                        {{$user2->descripcion}}

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
                  </form>

           
              </div><!-- /.box -->
          </div>

@section('javascript')

<script>

   CKEDITOR.replace('editor2')


  $('[data-mask]').inputmask()
  $('.select2').select2();



  @if ($user2)
    

    $('[name="proceso"]').val("{{$user2->proceso}}").trigger('change');
    $('[name="expediente"]').val("{{$user2->idexpediente}}").trigger('change');



      var images = "{{$user2->documentos}}";
      var ruta = "{{$ruta}}";
      
      var dd = images.split(",");
      var h,text="";

      for (var i = 0; i < dd.length - 1; i++) {

      	h = i+1;


      	text+="<a href='"+ruta+"/"+dd[i]+"'  target='_blank'> <div class='col-md-3 col-sm-4'><i class='fa fa-fw fa-file-pdf-o'></i> Documento"+h+"</div></a>";
  
      };


      $('#ver-image').html(text);





  @endif


$('#ingresar').click(function(){



         if (( $('[name="proceso"]').val() ==="") ||  ($('[name="expediente"]').val() ==="")) {
    


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
          url: "{{ route('casos.store') }}",                                          
          data: data,
          contentType: false,
          processData: false,
          method: 'POST',
      })
      .done(function(msg) {

        if (msg === "guardar") {
          var message = 'El Caso Fue Creado Correctamente';

        };

        if (msg === "editar") {
          var message = 'El Caso Fue Actualizado Correctamente';

        };

          window.location.href = "{{ route('casos.index') }}";

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


   var text1 = CKEDITOR.instances['editor2'].getData();


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
