<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'Inicio | Bufette H&M Legal.') </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue.min.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
   <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
  <!-- bootstrap Datatables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
 <link rel="stylesheet" href="{{ asset('plugins/datetimepicker/bootstrap-datetimepicker.css') }}" />

 <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">

   <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">

 
   <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

 <!--  <script src="{{ asset('dist/js/select2.js') }}"></script>-->
  <link rel="stylesheet" href="{{ asset('dist/css/select2.css') }}">
{{--   {!!HTML::script('dist/js/select2.js')!!}
  {!!HTML::style('dist/css/select2.css',['rel'=>'stylesheet'])!!} --}}




  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
           
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
      </span>
      <!-- logo for regular state and mobile devices -->
     <span class="logo-lg"><b>Bufette</b> H&M Legal.</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         

          <!-- Notifications Menu -->
       
          <li class="dropdown notifications-menu" id="text_noti"></li>



          <!-- Notifications Menu -->



          <li class="dropdown user user-menu">

            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{ asset('dist/img/user2-160x160.png') }}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{ asset('dist/img/user2-160x160.png') }}" class="img-circle" alt="User Image">

                 <p>
                  {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
                  <small>Miembro desde {{ Auth::user()->created_at }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">

                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">

                <div class="pull-right">

                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-danger">
                    Salir &nbsp;&nbsp;<i class="fa fa-sign-out"></i>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user2-160x160.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>


      <!-- /.search form -->

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú de opciones</li>

        @if(\App\Http\Controllers\RolesController::ver(1))
        <li class="active"><a href="{{ route('home') }}"><i class="fa fa-desktop"></i> <span>Inicio</span></a></li>
        @endif


        <li class="treeview">
          <a href="#"><i class="fa fa-folder-open"></i> <span>Expedientes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if(\App\Http\Controllers\RolesController::agregar(2))
             <li><a href="{{ route('expedientes.create') }}">Crear expediente</a></li>
            @endif

            @if(\App\Http\Controllers\RolesController::ver(2))
            <li><a href="{{ route('expedientes.index') }}">Listado de expedientes</a></li>
            @endif

          </ul>
        </li>


         <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Escritos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if(\App\Http\Controllers\RolesController::agregar(3))
             <li><a href="{{ route('escritos.create') }}">Crear escrito</a></li>
            @endif

            @if(\App\Http\Controllers\RolesController::ver(3))
            <li><a href="{{ route('escritos.index') }}">Listado de escritos</a></li>
            @endif

          </ul>
        </li>


        <li class="treeview">
          <a href="#"><i class="fa fa-suitcase"></i> <span>Casos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if(\App\Http\Controllers\RolesController::agregar(4))
             <li><a href="{{ route('casos.create') }}">Crear caso</a></li>
            @endif

            @if(\App\Http\Controllers\RolesController::ver(4))
            <li><a href="{{ route('casos.index') }}">Listado de casos</a></li>
            @endif

          </ul>
        </li>
     
     
     
  
       <li class="treeview">
          <a href="#"><i class="fa fa-university"></i> <span>Audiencias</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if(\App\Http\Controllers\RolesController::agregar(5))
             <li><a href="{{ route('audiencias.create') }}">Crear audiencias</a></li>
            @endif

            @if(\App\Http\Controllers\RolesController::ver(5))
            <li><a href="{{ route('audiencias.index') }}">Listado de audiencias</a></li>
            @endif

          </ul>
        </li>
     
 
        @if(\App\Http\Controllers\RolesController::ver(6))
        <li class="treeview">
          <a href="#"><i class="fa fa-gears"></i> <span>Configuración</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"> Usuarios
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

                 @if(\App\Http\Controllers\RolesController::agregar(7))
                 <li><a href="{{ route('usuarios.create') }}"><i class="fa fa-circle"></i> Crear usuario</a></li>
                 @endif

                 @if(\App\Http\Controllers\RolesController::ver(7))
                <li><a href="{{ route('usuarios.index') }}"><i class="fa fa-circle"></i> Listado de usuarios</a></li>
                 @endif

              </ul>
            </li>
             <li class="treeview">
              <a href="#"> Roles
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">


                  @if(\App\Http\Controllers\RolesController::agregar(8))
                  <li><a href="{{ route('roles.create') }}"><i class="fa fa-circle"></i> Crear rol</a></li>
                  @endif
   

                  @if(\App\Http\Controllers\RolesController::ver(8))
                  <li><a href="{{ route('roles.index') }}"><i class="fa fa-circle"></i> Listado de roles</a></li>
                  @endif


              </ul>
            </li>
            
          
          </ul>
        </li>
        @endif

        
        @if(\App\Http\Controllers\RolesController::ver(9))
        <li ><a href="{{ route('resetPassword') }}"><i class="fa fa-key"></i> <span>Cambiar Contraseña</span></a></li>
        @endif
  
        <li>
          <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <i class="fa fa-sign-out"></i>
                    <span class="s-text">Salir</span>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
          </a>
        </li>

      </ul>

    </section>

    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

  @yield('content')

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">

    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="#"><b> Bufette H&M Legal</b></a>.</strong> All rights reserved.
  </footer>
 
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('plugins/moment/moment.js') }}"></script>

<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>


<!-- <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>-->

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!--<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>-->
<!-- AdminLTE App -->


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<!-- Select2 -->
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/select2/i18n/es.js') }}"></script>

<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
<!-- bootstrap color picker -->
<!-- DataTable -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- Bootstrap Datetimepicker v4.17.47 -->
<script src="{{ asset('plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>

<!-- SweetAlert -->
<script src="{{ asset('plugins/sweetAlert/sweetalert.js') }}"></script>

<script src="{{ asset('bower_components/chart.js/Chart.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>


<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>


<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>


<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>





<script>
$( document ).ready(function() {

	  //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })




    agregarOrden();
     


    $('.datepicker').datepicker({
       autoclose: true,
       closeText: 'Cerrar',
       prevText: '< Ant',
       nextText: 'Sig >',
       currentText: 'Hoy',
       monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
       monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
       dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
       dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
       dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
       weekHeader: 'Sm',
       dateFormat: 'd/m/y',
       firstDay: 1,
       isRTL: false,
       showMonthAfterYear: false,
       yearSuffix: ''
    });


    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })


    function agregarOrden(){



      $.ajax({
          url: "{{ route('search_audiciones') }}",                                          
      })
      .done(function(msg) {

      	  //console.log(msg)

      	  var text='';
      	  var numero='';
      	  var mensaje='';
      	  var notifi='';

      	  if (msg.total === 0) {

      	       mensaje+='Usted no posee notificaciones';
      	       numero+= '';
      	       notifi+='';




      	  }else{

      	  	   if (msg.total === 1) {
      	          mensaje+="Usted tiene "+msg.total+" notificación";

      	  	   }else{

      	          mensaje+="Usted tiene "+msg.total+" notificaciones";


      	  	   };

      	       numero+="<span class='label label-warning'>"+msg.total+"</span>";


      	       for (var i = 0; i < msg.audiencias.length; i++) {

      	       	    var url = '{{ route("notificar", ":slug") }}';
                    url = url.replace(':slug', msg.audiencias[i].id);
                    
                    notifi+="<li> <a href='"+url+"'> <i class='fa fa-legal text-aqua'></i>Se acerca la fecha de la Audiencia #"+msg.audiencias[i].id+" </a> </li> ";
               };




      	  };






      	  text+="<a href='#' class='dropdown-toggle' data-toggle='dropdown'> <i class='fa fa-legal'></i>  "+numero+" </a> <ul class='dropdown-menu'> "+mensaje+"  <li> <ul class='menu'> "+notifi+"  </ul> </li> </ul>";



          $('#text_noti').html(text);


         

      })
      .fail(function(msg) {
            //console.log("error en createAlbarane");
      });



}





});
</script>

@yield('javascript')
<script type="text/javascript">
  $(function () {  });

</script>
</body>
</html>