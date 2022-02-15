@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>ECC Applications</a></li>
        </ol>
    </section>
@stop

<style>
  .pointer {cursor: pointer;}
</style>

@section('content')
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="box">
          <div class="box-header with-border">
            <img id="" src="../img/doc1.jpg" style="width:38px;"><h1 class="box-title"><b>ECC APPLICATIONS</b></h1>
          </div>
          <div class="box-body">
              <div class="box-header">
                Listed below are the ECC Applications. Click the corresponding folder icon to view attachments or the select icon to view details.
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-bordered" id="ECCApplicationsTable" style="width: 100%;  display: table; table-layout: fixed;">
                  <thead>
                      <th style="width: 50%">Details</th>
                      <th style="width: 30%">Status</th>
                      <th style="width: 20%"></th>
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
    $('#ECCApplicationsTable').DataTable({
      processing:true,
      info:true,
      ajax: {
            "url": "{{route('get.ecc.applications')}}",
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
      {data: 'Action', name: 'Action'},
      ]
    })

  });

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