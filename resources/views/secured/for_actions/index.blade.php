@extends('layouts.adminlte.default.layout')

<style>
  .pointer {cursor: pointer;}

  /*.dataTables_filter {
    display: none;
  */}

</style>

@section('header')
<section class="content-header">
  <center>
    <h2><b>
      EIA Dashboard
      <small></small>
    </b></h2>
  </center>
        <!-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-cog"></i>For Action</a></li>
        </ol -->
    </section>
@stop




@section('content')

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container-fluid">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
      <div class="box-body">
      </div>
    </div>

    <div class="box box-default">
      <div class="box-header with-border">
        <img id="" src="../img/Tools.jpg" style="width:38px;"> <b>Applications for Action - </b>
      </div>
      <div class="box-body">
        <div class="box-header">
          Listed below are the ECC Applications pending with you for appropriate action. Click the project name/address to load the application.
        </di v>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <!-- <input type="text" id="searchInput" placeholder="Type Keywords..."> -->
          <table class="table table-bordered" id="ForActionTable" style="width: 100%;  display: table; table-layout: fixed;">
            <thead style=" background-color: #f5f6f8">
              <th style="width: 40%; height: 30%">Details</th>
              <th style="width: 20%; height: 30%">Status</th>
              <th style="width: 40%; height: 30%">Remarks</th>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="box-header with-border">
        <!-- <h3 class="box-title"></h3> -->
        <a href="{{ url("/search/project-type") }}" class="btn btn-block btn-social btn-bitbucket btn-lg" style="text-align:center">
          APPLY FOR PERMIT
        </a>
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

<script>
var UserOffice = "{{session('data')['UserOffice']}}";
var UserName = "{{session('data')['UserName']}}";
var UserRole = "{{session('data')['UserRole']}}";
$(document).ready(function(){

  //Login success pop-up
  var message = "{{session()->get('msg')}}";
  if(message != ''){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: message
    })

  }
  

  ResetSession();
  localStorage.clear();

  $('#ForActionTable').DataTable({
    processing:true,
    info:true,
    ordering: false,
    // serverSide : true,
    scrollY: 250,
    deferRender: true,
    scroller:true,
    searching : true,
    ajax: {
      "url": "{{route('get.users.list')}}",
      "type": "POST",
      "data": {
        UserName : UserName,
        UserRole : UserRole,
        UserOffice : UserOffice,
        _token: '{{csrf_token()}}' ,
      },
    },
    columns: [
    {data: 'Details', name: 'Details'},
    {data: 'Status', name: 'Status'},
    {data: 'Remarks', name: 'Remarks'},
    ],
    language: 
    {
      'loadingRecords': '&nbsp;',
      'processing': '<div class="spinner"><img src="../../img/apply.png" /></div>Processing...'
    }
  });
});

function ResetSession(){
  $.ajax({
    url: "{{route('ResetInputs')}}",
    type: 'GET',
    success: function(response){
    }
  });
}


function NewDocument(result){
  var href = "NewDocument/";

  $.ajax({
    url: "{{route('putExistingDataInSession')}}",
    type: 'POST',
    data: {
      ProjectGUID : result,
      _token: '{{csrf_token()}}',
    },
    success: function(response){
      document.location = href + result;
    }
  }); 
}
</script>