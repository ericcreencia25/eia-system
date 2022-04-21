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
  <!--sweetalert-->
  <link rel="stylesheet" href="../../adminlte/dist/css/sweet-alert-2.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo" style="padding-bottom: 30px">
    <a href="../../index2.html"><img src="../../img/denr1.png" width="40" height="40" class="d-inline-block align-top" alt=""><small><b>User</b>Account<b>CRS</b></small></a>
  </div>
  <!-- User name -->
  @if(session()->get('msg'))
  <p class="text-red">You have entered invalid credentials or your account is not binded with ECC. <a href="{{ url("authentication/registerUrAccount") }}">  Click here to bind your account. </a></p>
  @endif

  {{Session::get('data')['UserId']}}
  <div class="lockscreen-name" >{{Session::get('data')['UserName']}}</div>
  <div class="lockscreen-name">{{Session::get('data')['Email']}}</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="../img/user.jpg" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form action="{{ route('first-time-login-user') }}" method="post" class="lockscreen-credentials">
      @csrf
      <div class="input-group">
        <input type="password" name="password" class="form-control" placeholder="********" id="password" min="6" required>

        <div class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
  </div>

  <div class="help-block text-center">
    @error('password')
    <p class="text-red">{{ $message }}</p>
    @enderror

    Enter your password to start your session
  </div>
  <div class="text-center">
    <a href="{{ url("logout") }}">Or sign in as a different user</a>
  </div>
</div>
<!-- /.center -->

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
<!---sweetalert2--->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
