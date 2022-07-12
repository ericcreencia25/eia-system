<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EIA</title>
  <!-- <link rel="icon" type="image/x-icon" href="../../imag/denr.png"> -->
  <link rel = "icon" type = "image/png" href="../img/denr1.png">
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->

  <!-- daterange picker -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="../../adminlte/bower_components/select2/dist/css/select2.min.css">

  <!-- Pace style -->
  <link rel="stylesheet" href="../../adminlte/plugins/pace/pace.min.css">

  <link rel="stylesheet" href="../../adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

     <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../adminlte/plugins/iCheck/all.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../adminlte/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/sweet-alert-2.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/overlay-success.css">

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css"/> -->

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />   

</head>
<style>
  .pointer {cursor: pointer;}
   .spinner-wrapper {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #022829;
      z-index: 999999;
    }
  </style>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <!-- Preloader -->
  <div class="spinner-wrapper">
    <img src="../../img/denr1.png" width="100" height="100" class="d-inline-block align-top" alt="" style="position: absolute;top: 48%;left: 45%;">
    <div class="spinner" style="position: absolute;top: 48%;left: 45%; width: 100px; height: 100px;" ></div>
  </div>

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="" class="navbar-brand" style="padding-top: 5px; padding-left: 0px;">
            <img src="../../img/denr1.png" width="40" height="40" class="d-inline-block align-top" alt="">
          </a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Statistics <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Status Per Region</a></li>
                <li><a href="#">Collection Per Region</a></li>
                <li><a href="#">Performance Per Region</a></li>
              </ul>
            </li>

            <li><a href="#">Email Notifications</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Tools <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Manage ECC</a></li>
                <li><a href="#">Manage Proponents</a></li>
                <li><a href="{{ url("administration/default") }}">Manage Users</a></li>
                <li><a href="{{ url("administration/signatories") }}">Manage Signatories</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Reports <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">ECC Issued</a></li>
                <li><a href="#">CNC Issued</a></li>
                <li><a href="#">Approval Exemption</a></li>
              </ul>
            </li>
            
          </ul>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"> <i class="fa fa-fw fa-user"></i> Welcome {{session('data')['UserName']}} </span>
            </a>
            <ul class="dropdown-menu">
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @if(session('data')['UserRole'] != 'Sysad')
                  <li>
                    <a href="#">Manage Account
                    </a>
                  </li>
                  <li>
                    <a href="#">User's Manual</a>
                  </li>
                  <li>
                    <a href="{{ url("logout") }}" >Sign out</a>
                  </li>
                  @else
                  <li>
                    <a href="#">Manage Users
                    </a>
                  </li>

                  <li>
                    <a href="{{ url("administration/signatories") }}">Manage Signatories
                    </a>
                  </li>

                  <li>
                    <a href="#">Manage Account
                    </a>
                  </li>

                  <li>
                    <a href="#">Statistics
                    </a>
                  </li>

                  <li>
                    <a href="#">Bank Reports
                    </a>
                  </li>

                  <li>
                    <a href="#">User's Manual</a>
                  </li>
                  <li>
                    <a href="{{ url("logout") }}" >Sign out</a>
                  </li>

                  @endif
                  <!-- end task item -->
                </ul>
              </li>
            </ul>
          </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->

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

<!-- jQuery 3 -->
<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- SlimScroll -->
<script src="../../adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../adminlte/bower_components/fastclick/lib/fastclick.js"></script>

<!-- InputMask -->
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- PACE -->
<script src="../../adminlte/bower_components/PACE/pace.min.js"></script>




<!-- date-range-picker -->
<script src="../../adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="../../adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script><!-- bootstrap datepicker -->
<script src="../../adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../adminlte/dist/js/demo.js"></script>

<!-- iCheck 1.0.1 -->
<script src="../../adminlte/plugins/iCheck/icheck.min.js"></script>

<script src="../../adminlte/dist/js/bootstrap-switch.js"></script>

<!-- DataTables -->
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!---sweetalert2--->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
</html>


<script>

  $(document).ready(function(){
    $("#newApplication").click(function(){
      // var href = "NewDocument/";
      ResetSession();
      localStorage.clear();

      $.ajax({url: "{{route('createNewGUID')}}", 
        success: function(result){
          

          document.location.href = "/NewDocument/" + result;
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

    //Preloader
    preloaderFadeOutTime = 500;
    function hidePreloader() {
    var preloader = $('.spinner-wrapper');
    preloader.fadeOut(preloaderFadeOutTime);
    }
    hidePreloader();

  });

function ResetSession(){
  $.ajax({
    url: "{{route('ResetInputs')}}",
    type: 'GET',
    success: function(response){
    }
  });
}
</script>