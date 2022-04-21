<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EIA</title>
<link rel = "icon" type = "image/png" href="../img/denr1.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../adminlte-3.1.0/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/sweet-alert-2.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-lightblue navbar-light">
    <div class="container">
      <a href="../../adminlte-3.1.0/index3.html" class="navbar-brand">
        <!-- <img src="../../img/denr1.png" width="40" height="40" class="d-inline-block align-top" alt=""> -->
        <img src="../../img/denr1.png" alt="EIA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav" >
          <li class="nav-item">
            <a href="index3.html" class="nav-link" style="color: white">For Action</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="color: white">New Application</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="color: white">ECC Application</a>
          </li>
        </ul>

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->

          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" style="color: white">
              <i  class="fa fa-fw fa-user"></i> Welcome {{session('data')['UserName']}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- <span class="dropdown-header">15 Notifications</span> -->
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                Manage Account
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                User's Manual
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" onclick="logout()">
                Sign out
              </a>
          </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            @yield('header')

            <!-- Main content -->
            <section class="content container-fluid" id="container-fluid">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->


<!-- <script src="../../adminlte-3.1.0/plugins/jquery/jquery.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/select2/js/select2.full.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/moment/moment.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/inputmask/jquery.inputmask.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/daterangepicker/daterangepicker.js"></script>

<script src="../../adminlte-3.1.0/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/bs-stepper/js/bs-stepper.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/dropzone/min/dropzone.min.js"></script>

<script src="../../adminlte-3.1.0/dist/js/adminlte.min.js"></script>

<script src="../../adminlte-3.1.0/dist/js/demo.js"></script> -->

<!---sweetalert2--->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function logout(){
  Swal.fire({
    title: 'Are you sure you want to sign out?',
    showDenyButton: false,
    showCancelButton: false,
    confirmButtonText: 'Sign out',
    denyButtonText: `Cancel`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.ajax({
        url: "{{route('logout')}}",
        type: 'GET',
        success: function(response){
          location.reload();
        }
      });
    } else if (result.isDenied) {
      // Swal.fire('Changes are not saved', '', 'info')
    }
  })

  
}
  </script>
</body>
</html>
