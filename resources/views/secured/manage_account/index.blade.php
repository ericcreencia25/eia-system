@extends('layouts.adminlte.default.layout')
  

@section('header')
<section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>Manage Account</a></li>
        </ol>
    </section>
@stop




@section('content')

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container-fluid">

    <div class="box box-default">
      <div class="box-header with-border">
        <img id="" src="../img/lock.jpg" style="width:38px;"> <b>MANAGE ACCOUNT </b>
      </div>
      <div class="box-body">
        <!-----PASSWORD----->
        <div class="box-header">
          Update Password - It is recommended that you change your password periodically. Password should be 8-character length.
        </div>
        @if(session()->get('success1'))
        <div class="col-sm-3"></div>
        <div class="alert alert-success alert-dismissible col-sm-6">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          Successfully changed your password.
        </div>
        <div class="col-sm-3"></div>

        @endif
        <form class="form-horizontal"  action="{{ route('updateAccount') }}" method="post">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Current Password: </label>
              <div class="col-sm-5">
                <input type="password" class="form-control" id="currentpassword" placeholder="Current Password" min="6" name="currentpassword" autocomplete="currentpassword" required>
              </div>
              @error('currentpassword')
                <p class="text-red">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">New Password: </label>

              <div class="col-sm-5">
                <input type="password" class="form-control" id="newpassword" placeholder="New Password"  min="6" name="newpassword" autocomplete="newpassword" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Confirm Password: </label>

              <div class="col-sm-5">
                <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" min="6" name="confirmpassword" autocomplete="confirmpassword" required>
              </div>
              @error('newpassword')
                <p class="text-red">{{ $message }}</p>
              @enderror
              @error('confirmpassword')
                <p class="text-red">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-5 control-label"></label>

              <div class="col-sm-3">
                <button type="submit" class="btn btn-block btn-default" name="updatepassword">Update</button>
              </div>
            </div>
          </div>
        </form>
        <!-------END-------->
        <!-------BASIC INFO-------->
        <div class="box-header">
          Basic Info - Please provide the valid contact information below. The information below will be used for password recovery and other notifications purposes.
        </div>
        @if(session()->get('success2'))
        <div class="col-sm-3"></div>
        <div class="alert alert-success alert-dismissible col-sm-6">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          Basic Information updated successfully.
        </div>
        <div class="col-sm-3"></div>

        @endif
        <form class="form-horizontal" action="{{ route('updateAccount') }}" method="post">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Primary Email: </label>
              <div class="col-sm-5">
                <input type="email" class="form-control" id="primaryemail" name="primaryemail" placeholder="Primary Email" value="{{Session::get('data')['Email']}}" autocomplete="primaryemail" readonly="readonly">
              </div>
              @error('primaryemail')
                <p class="text-red">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Alternate Email: </label>

              <div class="col-sm-5">
                <input type="email" class="form-control" id="alternateemail" name="alternateemail" placeholder="Alternate Email" value="{{Session::get('data')['AlternateEmail']}}"  autocomplete="alternateemail">
              </div>
              @error('alternateemail')
                <p class="text-red">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Mobile No: </label>

              <div class="col-sm-5">
                <input type="number" class="form-control" id="mobileno" name="mobileno" placeholder="Mobile No" value="{{Session::get('data')['MobileAlias']}}" autocomplete="mobileno">
              </div>
              @error('mobileno')
                <p class="text-red">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Birth Date: </label>

              <div class="col-sm-5">
                <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" placeholder="yyyy-mm-dd" value="{{Session::get('data')['BirthDate']}}" autocomplete="datepicker">
              </div>
              @error('datepicker')
                <p class="text-red">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-5 control-label"></label>

              <div class="col-sm-3">
                <button type="submit" class="btn btn-block btn-default" name="updatebasicinfo" id="updatebasicinfo">Update</button>
              </div>
            </div>
          </div>
        </form>
        <!-----END------>
        <!-----SMS----->
        <div class="box-header">
          Add-on SMS Authentication during login - Please ensure you have access to your cellphone when enabling/disabling this feature and during system login when enabled (UNDER DEVELOPMENT).
        </div>
        <form class="form-horizontal" action="#" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">SMS authentication is currently: </label>
              <p class="text-green col-sm-1" style="font-size: 18px">Enabled</p>

              <div class="col-sm-5">
                <input type="text" class="form-control" id="" placeholder="Enter the SMS Code here">
              </div>
            </div>
            
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-5 control-label"></label>
              <div class="col-sm-2">
                <button type="button" class="btn btn-block btn-default">Get Code</button>
              </div>

              <div class="col-sm-2">
                <button type="button" class="btn btn-block btn-default">Disable SMS</button>
              </div>
            </div>
          </div>
        </form>
        <!-------END-------->
        <!-----EMAIL----->
        <div class="box-header">
          Add-on: Email Authentication during login - Please ensure you have access to the email address indicated above when enabling/disabling this feature and during system login when enabled (UNDER DEVELOPMENT).
        </div>
        <form class="form-horizontal" action="#" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Email authentication is currently: </label>

              <p class="text-green col-sm-1" style="font-size: 18px">Disabled</p>

              <div class="col-sm-5">
                <input type="text" class="form-control" id="" placeholder="Enter the Email Code here">
              </div>

              
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-5 control-label"></label>
              <div class="col-sm-2">
                <button type="button" class="btn btn-block btn-default">Get Code</button>
              </div>

              <div class="col-sm-2">
                <button type="submit" class="btn btn-block btn-default" id="smsupdate">Enable Email</button>
              </div>
            </div>
          </div>
        </form>
        <!-------END-------->
      </div>
    </div>

  </section>
</div>
@stop
<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- DataTables -->
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="../../adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../adminlte/dist/js/demo.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script> -->

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

<script src="../../adminlte/dist/js/bootstrap-switch.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyB6K1CFUQ1RwVJ-nyXxd6W0rfiIBe12Q&libraries=places" type="text/javascript"></script>

<!-- iCheck 1.0.1 -->
<script src="../../adminlte/plugins/iCheck/icheck.min.js"></script>



<script>
var UserOffice = "{{session('data')['UserOffice']}}";
var UserName = "{{session('data')['UserName']}}";
var UserRole = "{{session('data')['UserRole']}}";
var cPassword = "{{session('data')['Password']}}";

$(document).ready(function(){
  $('#datepicker').datepicker({
       todayBtn: "linked",
       language: "it",
       autoclose: true,
       todayHighlight: true,
       format: 'yyyy-mm-dd' 
   });
});
</script>