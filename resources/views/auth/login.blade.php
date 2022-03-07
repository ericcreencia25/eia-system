<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log In</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../adminlte/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
  <link rel="stylesheet" href="../../adminlte/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">EIAMD<span class="sr-only"></span></a></li>
            <li><a href="#">HELP</a></li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a>
                <span class="hidden-xs"><b>For technical assistance, please email your concerns to support@emb.gov.ph</b></span>
              </a>
              
            </li>
          </ul>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->

  <div class="content-wrapper">
    <section class="content container-fluid">
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <p class="text-center">
                    <strong></strong>
                  </p>
                  <center>
                    <img class="img-responsive" src="../../img/denr.png" alt="Photo" width="175" height="178">
                    <h2>Environmental Management Bureau</h2>
                    <p style="text-align:justify; padding-left:5%; padding-right:5%;">Welcome to the EMB Environmental Impact Assessment and Management Division’s ECC Online Application System for Non-Environmentally Critical Projects (NECPs) located within Environmentally Critical Areas (ECAs) and within threshold that requires an IEE Checklist. <br /><br />For projects not covered under the PEISS, click the link below to apply for the Certificate of Non-Coverage or login to verifying the coverage of your project. <br /><br />
                    <a href="#">CNC Online Application</a><br>
                </center>

                
                </div>

                <div class="col-md-6">
                  <div class="login-box">
                    <div class="login-logo">
                      <a href="../../new_applications/1"><b>User Account</b></a>
                    </div>
                    <!-- /.login-logo -->
                     <!-- <form method="post" action="{{ url('/login/checklogin') }}"> -->
                      
                      <div class="login-box-body">
                        <p class="login-box-msg">Sign in to start your session</p>
                        @if(session()->get('msg'))
                          <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            You have entered invalid credentials
                          </div>
                          @endif
                        <form action="{{ route('login-user') }}" method="post">
                          @csrf
                          <div class="form-group has-feedback">
                            <input type="text" name="username"  class="form-control" placeholder="Full Name use during registration" id="username">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                          </div>
                          <div class="form-group has-feedback">
                            <input type="password" name="password" class="form-control" placeholder="********" id="password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                          </div>
                          <div class="row">
                            <div class="col-xs-7">
                              <div class="checkbox icheck">
                                <label>
                                <input type="checkbox"> Keep me logged in
                                </label>
                              </div>
                            </div>
                            <!-- /.col -->
                          <div class="col-xs-5">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" >Log In</button>
                            <button type="button" class="btn btn-warning btn-block btn-flat" id='log-in-crs'>Log In w/CRS</button>
                          </div>
                          <!-- /.col -->
                          </div>
                        </form>
                        <a href="#">Can't sign-in to your account?</a><br>
                        Not yet registered? <a href="register.html" class="text-center"><b>Sign-up now!</b></a>
                      </div>
                  <!-- </form> -->
                  </div>
                  <div style="background-color:brown; padding:10px; color:white; ">
                    You may pay the ECC/CNC/OPMS through the Landbank internet-based facility. Click <a href="../../files/LinkBiz.pdf" target='_blank'>HERE</a> to download the quickguide.
                  </div>
                  <br />
                  <div style="background-color:brown; padding:10px; color:white; "> 
                    Click <a href='https://dict.gov.ph/pnpki-individual-certificate/' target='_blank'>HERE</a> for free Digital Certificate from DICT. Use of Digital Signature on electronic documents is highly recommended.
                  </div>   
                </div>
              </div>
            </div>
          </div>
    </section>
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2021 <a href="">Erik's Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../adminlte/dist/js/demo.js"></script>
<!-- iCheck -->
<script src="../../adminlte/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  $(document).ready(function(){
    

    $("#log-in-crs").on('click', function() {
      var UserName = $("input[name=username]").val();
      var Password = $("input[name=password]").val();

      $.ajax({
        url: "{{route('loginCRS')}}",
        type: 'POST',
        data: {
          UserName : UserName,
          Password : Password,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
        }
      });
    });
  });
  
</script>
</body>
</html>
