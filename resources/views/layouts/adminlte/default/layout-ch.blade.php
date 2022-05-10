<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/overlay-success.css">
  
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand-md navbar-primary navbar-dark" style="background-color: #1E8CBE">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <span class="brand-text font-weight-light" style="color: white"><b>ECC</b></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">


          @if(session('data')['UserRole'] == 'Evaluator')
              <li class="nav-item"><a href="{{ url("default") }}" class="nav-link" style="color: white">For Action <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"> <a href="{{ url("documents") }}" class="nav-link" style="color: white">ECC Applications</a></li>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search Applications">
                </div>
              </form>
              <li class="nav-item"><a href="" class="nav-link" style="color: white">Load ECC Dashboard</a></li>
              <li class="nav-item"><a href="" class="nav-link" style="color: white">Go to CNC Online</a></li>
              @else
              <li class="nav-item"><a href="{{ url("default") }}" class="nav-link" style="color: white">For Action <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a href='' id="newApplication" class="nav-link" style="color: white">New Application</a></li>
              <li class="nav-item"><a href="{{ url("documents") }}" class="nav-link" style="color: white">ECC Applications</a></li>
              @endif
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" style="color: white">
            <i class="far fa-bell"> Welcome {{session('data')['UserName']}}</i>
            <!-- <span class="badge badge-warning navbar-badge">15</span> -->
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- <span class="dropdown-header">15 Notifications</span> -->
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> Manage Account
              <!-- <span class="float-right text-muted text-sm"></span> -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> User's Manual
              <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ url("logout") }}" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> Logout
              <!-- <span class="float-right text-muted text-sm">2 days</span> -->
            </a>
            <div class="dropdown-divider"></div>
            <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Full Width Column -->

  <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            @yield('header')

            <!-- Main content -->
            <section class="content container-fluid">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../adminlte-3.1.0/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../adminlte-3.1.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../adminlte-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../adminlte-3.1.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/jszip/jszip.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="../../adminlte-3.1.0/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../adminlte-3.1.0/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../adminlte-3.1.0/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../adminlte-3.1.0/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../adminlte-3.1.0/plugins/moment/moment.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../adminlte-3.1.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../adminlte-3.1.0/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../adminlte-3.1.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte-3.1.0/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../adminlte-3.1.0/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../adminlte-3.1.0/dist/js/pages/dashboard.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</body>
</html>


<script>

  $(document).ready(function(){
    $("#newApplication").click(function(){
      var href = "NewDocument/";

      $.ajax({url: "{{route('createNewGUID')}}", 
        success: function(result){
          document.location = href + result;
        }});
    });


    // toastr.options = {
    //   "debug": false,
    //   "positionClass": "toast-bottom-left",
    //   "onclick": null,
    //   "fadeIn": 300,
    //   "fadeOut": 1000,
    //   "timeOut": 5000,
    //   "extendedTimeOut": 1000,
    // }

  });
</script>