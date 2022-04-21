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

  <!-- iCheck for checkboxes and radio inputs -->
  <!-- <link rel="stylesheet" href="../../adminlte-3.1.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
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
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" style="color: white">Statistics</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
              <li><a href="#" class="dropdown-item">Status per Region </a></li>
              <li><a href="#" class="dropdown-item">Status per Region</a></li>
              <li><a href="#" class="dropdown-item">Performance per Region</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index3.html" class="nav-link" style="color: white">Email Notifications</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" style="color: white">Tools</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
              <li><a href="#" class="dropdown-item">Manage ECC</a></li>
              <li><a href="#" class="dropdown-item">Manage Proponents</a></li>
              <li><a href="{{ url("administration/default") }}" class="dropdown-item">Manage Users</a></li>
              <li><a href="{{ url("administration/signatories") }}" class="dropdown-item">Manage Signatories</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" style="color: white">Reports</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
              <li><a href="#" class="dropdown-item">ECC Issued</a></li>
              <li><a href="#" class="dropdown-item">CNC Issued</a></li>
              <li><a href="#" class="dropdown-item">Approval Exemption</a></li> 
            </ul>
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
      </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->


<!-- <script src="../../adminlte-3.1.0/plugins/jquery/jquery.min.js"></script> -->

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

<!-- Bootstrap Switch -->
<script src="../../adminlte-3.1.0/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- <script src="../../adminlte-3.1.0/dist/js/demo.js"></script> -->

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
        window.location.href ='/default';
        // console.log(document.location.origin + '/default');
      } else if (result.isDenied) {
        // Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }
</script>
</body>
</html>
