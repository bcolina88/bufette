<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Formulario </h3>
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
                      {!! Form::label('Nombre', 'Nombre') !!}
                      {!! Form::text('tipo', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
                    </div>
                  
                    </div>


                  <div class="col-sm-12">
                     <label>Campo Obligatorio
                            <span class="symbol required"></span>
                     </label>
                     <br><br>
                     <span class="h4">Permisos</span>
                     <p class="text-muted">Seleccione los permisos del nuevo rol.</p>
                     <br><br>

                  </div> 

                  <div class="col-sm-12">              
                        <div class="panel-body">                
                            <div class="table-responsive">


                              <table class="table table-bordered table-hover table-responsive" id="table-articulos">
                                  <thead>
                                  <tr>
                                    <th>Maestro</th>
                                    <th>Agregar</th>
                                    <th>Editar</th>
                                    <th>Ver</th>
                                    <th>Inhabilitar</th>
                                    <th>Borrar</th>
                                  </tr>
                                  </thead>
                                  <tbody >
                                    <tr>
                                      <td></td>
                                      <td>
                                      
                                        <button type="button" class="form-group has-warning form-control" onclick="toggleAll('agregar')" ><i id="variant1" class="fa fa-times text-danger"></i>&nbsp; Todos</button>
                                      </td>
                                      <td>
                                        <button type="button" class="form-group has-warning form-control" onclick="toggleAll('editar')" ><i id="variant2" class="fa fa-times text-danger"></i>&nbsp; Todos</button>
                                     
                                      </td>
                                      <td>
                                        <button type="button" class="form-group has-warning form-control" onclick="toggleAll('ver')" ><i id="variant3" class="fa fa-times text-danger"></i>&nbsp; Todos</button>
                                        
                                      </td>
                                      <td>
                                        <button type="button" class="form-group has-warning form-control" onclick="toggleAll('inhabilitar')" ><i id="variant4" class="fa fa-times text-danger"></i>&nbsp; Todos</button>
                                        
                                      </td>
                                      <td>
                                        <button type="button" class="form-group has-warning form-control" onclick="toggleAll('borrar')" ><i id="variant5" class="fa fa-times text-danger"></i>&nbsp; Todos</button>
                                        
                                      </td>
                                   </tr>

                                    <tr style="background-color: transparent;">
                            
                                      
                                    </tr>
                                  </tbody>

                            </table>

                          </div>
                        
                        </div> 
                  </div>

                  <div class="col-sm-12">
                    <div class="row no-print">
                        <div class="col-xs-12">
                 
                     
                          <button type="button" class="btn btn-primary pull-right"  id="guardar" style="margin-right: 5px;" > Enviar </button>
                     


                        
                        </div>
                      </div>
                  </div>
     
                  </div>

                  </div><!-- /.box-body -->
                  <div class="box-footer">
                  </div>
                  </div>
                
              </div><!-- /.box -->
          </div>

 <div class="clearfix"></div>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
   

@section('javascript')
<script>

var permisos = [];
var status1 = false;
var status2 = false;
var status3 = false;
var status4 = false;
var status5 = false;

$(function () {

  @if ($tipo=="crear")
    permisoss();


  @endif

  @if ($tipo=="editar")


      $.ajax({
        url: "{{ route('getRoleInfo') }}",
        type: 'GET',
        dataType: 'json',
        data: {
          "id": {{$role->id}}
        }       
      })
      .done(function(msg) {

        permisos = msg.permisos;
        listPermission(permisos);

      })
      .fail(function(msg) {
        console.log("error en selectArticleID");
      });

    
  @endif


    $('#guardar').click(function(){


      $.ajax({
        url: "{{ route('roles.store') }}",
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({ 
            "_token":         "{{ csrf_token() }}",
            "name":            $('[name="tipo"]').val(),
            "permissions":     permisos,
            "tipo":     "{{$tipo}}"
        })
      })       
      .done(function(msg) {

        console.log(msg)

        if (msg === "creado") {

          var message = 'El rol Fue Creado Correctamente';
          //window.location.href = "{{ route('roles.index') }}";

        };


        if (msg === "editar") {

          var message = 'El rol Fue Editado Correctamente';
          //window.location.href = "{{ route('roles.index') }}";

        };

        
        window.location.href = "{{ route('roles.index') }}";

      })
      .fail(function(msg) {
        console.log("error en selectArticleID");
      });

     
          
    });

 

});


function permisoss(){
     
     $.ajax({
        url: "{{ route('permissions') }}",
        type: 'GET',
        dataType: 'json'        
      })
      .done(function(msg) {


        permisos = msg;
        listPermission(permisos);


      })
      .fail(function(msg) {
        console.log("error en selectArticleID");
      });

    
    
}


function toggleAll(tipo){
     

        if(tipo === "agregar"){
          if(status1 === false){
              
              status1 = true;
              $('#variant1').removeClass('fa fa-times text-danger');
              $('#variant1').addClass('fa fa-check text-success');


          }else{
             
              status1 = false;
              $('#variant1').removeClass('fa fa-check text-success');
              $('#variant1').addClass('fa fa-times text-danger');

          }

        }

        if(tipo === "inhabilitar"){
          if(status4 === false){
            
              status4 = true;
              $('#variant4').removeClass('fa fa-times text-danger');
              $('#variant4').addClass('fa fa-check text-success');
          }else{
         
              status4 = false;
              $('#variant4').removeClass('fa fa-check text-success');
              $('#variant4').addClass('fa fa-times text-danger');
          }
        }

        if(tipo === "editar"){
          if(status2 === false){

              status2 = true;
              $('#variant2').removeClass('fa fa-times text-danger');
              $('#variant2').addClass('fa fa-check text-success');
          }else{
  
              status2 = false;
              $('#variant2').removeClass('fa fa-check text-success');
              $('#variant2').addClass('fa fa-times text-danger');
          }
        }


        if(tipo === "ver"){
          if(status3 === false){

              status3 = true;
              $('#variant3').removeClass('fa fa-times text-danger');
              $('#variant3').addClass('fa fa-check text-success');
          }else{

              status3 = false;
              $('#variant3').removeClass('fa fa-check text-success');
              $('#variant3').addClass('fa fa-times text-danger');
          }
        }

        if(tipo === "borrar"){
          if(status5 === false){
 
              status5 = true;
              $('#variant5').removeClass('fa fa-times text-danger');
              $('#variant5').addClass('fa fa-check text-success');
          }else{

              status5 = false;
              $('#variant5').removeClass('fa fa-check text-success');
              $('#variant5').addClass('fa fa-times text-danger');
          }
        }

        var pp = permisos;
     
        var base = pp[0][tipo] === 1 ? 0 : 1;
        for (var i = 0; i < pp.length; i++) {
            pp[i][tipo] = base;
        }

        eliminar();
        listPermission(pp);
   
    
}





function changePermission(index,item,tipo) {


     var pp = permisos;
     var tt,changee;
    

     if (tipo ==1) {
         tt="agregar";
         if(item == 1){
            changee = 0;
         }else{
            changee = 1;
         };
     };

     if (tipo ==2) {
         tt="editar";
         if(item == 1){
            changee = 0;
         }else{
            changee = 1;
         };

     };

     if (tipo ==3) {
         tt="ver";
         if(item == 1){
            changee = 0;
         }else{
            changee = 1;
         };

     };

     if (tipo ==4) {
         tt="inhabilitar";
         if(item== 1){
            changee = 0;
         }else{
            changee = 1;
         };

     };

     if (tipo ==5) {
         tt="borrar";
         if(item == 1){
            changee = 0;
         }else{
            changee = 1;
         };

     };


     pp[index-1][tt] = changee;


     eliminar();
     listPermission(pp);

        
}


function listPermission(p) {


        var ii =1;


        p.forEach(function(item) {
        //agregamos los items a la tabla.


              var icon_agregar = "";
              var icon_editar = "";
              var icon_ver = "";
              var icon_inhabilitar = "";
              var icon_borrar = "";


              if(!item.agregar){ 
                   icon_agregar = 'fa fa-times text-danger';
              }else{
                   icon_agregar = 'fa fa-check text-success';
              }

              if(!item.editar){ 
                   icon_editar = 'fa fa-times text-danger';
              }else{
                   icon_editar = 'fa fa-check text-success';
              }

              if(!item.ver){ 
                   icon_ver = 'fa fa-times text-danger';
              }else{
                   icon_ver = 'fa fa-check text-success';
              }

              if(!item.inhabilitar){ 
                   icon_inhabilitar = 'fa fa-times text-danger';
              }else{
                   icon_inhabilitar = 'fa fa-check text-success';
              }

              if(!item.borrar){ 
                   icon_borrar = 'fa fa-times text-danger';
              }else{
                   icon_borrar = 'fa fa-check text-success';
              }

 
              $('#table-articulos tbody').append('<tr id="tr_'+ii+'">'+
                  '<td  style="width: 90px;">'+ item.maestro.titulo +'</td>'+
                  '<td> <a  onclick="changePermission('+ii+','+item.agregar+',1)" > <i class="'+icon_agregar+'"></i></a></td>'+
                  '<td> <a  onclick="changePermission('+ii+','+item.editar+',2)" name="" >  <i class="'+icon_editar+'"></i></a></td>'+ 
                  '<td> <a  onclick="changePermission('+ii+','+item.ver+',3)" name="" >  <i class="'+icon_ver+'"></i></a></td>'+ 
                  '<td> <a  onclick="changePermission('+ii+','+item.inhabilitar+',4)" name="" >  <i class="'+icon_inhabilitar+'"></i></a></td>'+ 
                  '<td> <a  onclick="changePermission('+ii+','+item.borrar+',5)" name="" > <i class="'+icon_borrar+'"></i></a></td>'+ 
                 '</tr>'); 

              ii++;
        });

}


function eliminar() {

     var pp = permisos;

     for (var i = 1; i <= permisos.length; i++) {
        $('#table-articulos tr#tr_'+i).remove();
       
     };

}



</script>
   
@endsection
