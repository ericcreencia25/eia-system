@extends('layouts.adminlte.default.layout-ch')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <!-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-cog"></i>For Action</a></li>
        </ol> -->
    </section>
@stop


<style>
  .pointer {cursor: pointer;}
</style>

@section('content')

    <div class="content">
      <!-- Main content -->
      <section class="container-fluid">
        <div class="card box-default">
          <div class="card-header with-border">
            <img id="" src="../img/tools.jpg" style="width:38px;"> <b>Applications for Action - </b>
          </div>
          <div class="card">
          <div class="card-header">
                Listed below are the ECC Applications pending with you for appropriate action. Click the project name/address to load the application.
              </div>
              <!-- /.box-header -->
              <div class="card-body no-padding">
                <table class="table table-bordered" id="ForActionTable" style="width: 100%;  display: table; table-layout: fixed;">
                  <thead>
                      <th style="width: 40%">Details</th>
                      <th style="width: 20%">Status</th>
                      <th style="width: 40%">Remarks</th>
                  </thead>
                  <tbody></tbody>
                </table> 
              </div>
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

<script>
var UserOffice = "{{session('data')['UserOffice']}}";
var UserName = "{{session('data')['UserName']}}";
var UserRole = "{{session('data')['UserRole']}}";
$(document).ready(function(){
  ResetSession();

  $('#ForActionTable').DataTable({
    processing:true,
    info:true,
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
    ]
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
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          document.location = href + result;
        }
      });

    
  }
</script>