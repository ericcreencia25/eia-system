<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="../../adminlte/plugins/iCheck/square/blue.css">

   <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <!-- <a href="../../index2.html"><b>User</b>Account</a> -->

    <a href="../../index2.html"><img src="../../img/denr1.png" width="40" height="40" class="d-inline-block align-top" alt=""><small><b>User</b>Account</small></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Bind your account</p>
      <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

    
      @if(session()->get('success'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Successfully binded.
      </div>
      @endif
    <form action="{{ route('saveRegister') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" value="{{Session::get('data')['UserName']}}" id="username" name="username" autocomplete="username" readonly="readonly">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('username')
          <p class="text-red">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" value="{{Session::get('data')['Email']}}" id="email" name="email" autocomplete="email" readonly="readonly">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
          <p class="text-red">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required autocomplete="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <!-- <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" id="password-confirmation" name="password-confirmation" required autocomplete="password-confirmation">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        @error('password')
          <p class="text-red">{{ $message }}</p>
        @enderror

      </div> -->
      @error('password')
          <p class="text-red">{{ $message }}</p>
        @enderror
      

      <div class="form-group has-feedback">
        <label>Gender:</label>
        <select class="form-control" id="gender" name="gender"> 
          <option value="Mr.">Male</option>
          <option value="Ms.">Female</option>
        </select> 
      </div>

      <!-- <div class="form-group has-feedback">
        <label>Birthdate:</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" placeholder="yyyy-mm-dd">
        </div>
        @error('datepicker')
          <p class="text-red">{{ $message }}</p>
        @enderror
      </div> -->

      <div class="row">
        <div class="col-xs-12">
          {!! NoCaptcha::renderJs() !!}
          {!! NoCaptcha::display() !!}

          @error('g-recaptcha-response')
            <p class="text-red">{{ $message }}</p>
          @enderror

        </div>
      </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="save">Save</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ url("default") }}" class="text-center"><u>Already binded</u></a><br>
    <a href="{{ url("logout") }}" class="text-center"><u>Back to Login</u></a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../adminlte/plugins/iCheck/icheck.min.js"></script>

<!-- InputMask -->
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script src="../../adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    // $('#datepicker').datepicker({
    //   autoclose: true
    // });
    // $('#datepicker').datepicker();

    $('#datepicker').datepicker({
       todayBtn: "linked",
       language: "it",
       autoclose: true,
       todayHighlight: true,
       format: 'yyyy-mm-dd' 
   });

    // $('#save').on('click', function () {
    //   var password = $("#txtPassword").val();
    //   var confirmPassword = $("#txtConfirmPassword").val();
    //   var username = $("#username").val();
    //   var email = $("#email").val();
    //   var gender = $("#gender").val();
    //   var date = $("#datepicker").val();

    //   if (password != confirmPassword) {

    //     alert("Passwords do not match.");
    //     return false;

    //   } else {

    //     $.ajax({
    //       url: "{{route('saveRegister')}}",
    //       type: 'POST',
    //       data: {
    //         password : password,
    //         confirmPassword : confirmPassword,
    //         username : username,
    //         email : email,
    //         gender : gender,
    //         date : date,
    //         _token: '{{csrf_token()}}' ,
    //       },
    //       success: function(response){
    //         alert("Passwords success.");
    //       }
    //     });

    //   }
    // });

    // var onloadCallback = function() {
    //   alert("grecaptcha is ready!");
    // };
  });

</script>
</body>
</html>
