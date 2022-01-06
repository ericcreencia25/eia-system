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

@section('content')
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="box">
          <div class="box-header with-border">
            <img id="" src="../img/doc1.jpg" style="width:38px;"><h1 class="box-title"><b>ECC APPLICATIONS</b></h1>
          </div>
          <div class="box-body">
            <div class="col-md-9">
              <div class="box-header">
                Listed below are the ECC Applications. Click the corresponding folder icon to view attachments or the select icon to view details.
              </div>
            </div>
              <div class="col-md-3">
                <select class="form-control pull-right" id="status_filter" >
                  <option value="Pending All">Pending All</option>
                  <option value="Pending with Proponents">Pending with Proponents</option>
                  <option value="Pending with EMB" selected>Pending with EMB</option>
                  <option value="Decided">Decided</option>
                  <option value="Approved">Approved</option>
                  <option value="Approved (Auto)">Approved (Auto)</option>
                  <option value="Denied">Denied</option>
                </select>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-bordered" id="ECCApplicationsTable" style="width: 100%;  display: table; table-layout: fixed;">
                  <thead>
                      <th style="width: 50%">Details</th>
                      <th style="width: 20%">Status</th>
                      <th style="width: 30%">Remarks</th>
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
    var status_filter = $("#status_filter").val();

    dataTable(status_filter);

    $("#status_filter").on('change', function() {
      var status_filter = $("#status_filter").val();
      dataTable(status_filter);
    });
    
  });

function dataTable(status_filter){
  $('#ECCApplicationsTable').DataTable({
      destroy : true,
      processing:true,
      info:true,
      searching:false,
      ajax: {
            "url": "{{route('get.ecc.applications')}}",
            "type": "POST",
            "data": {
                UserName : UserName,
                UserRole : UserRole,
                UserOffice : UserOffice,
                StatusFilter :status_filter,
                _token: '{{csrf_token()}}' ,
            }, 
        },
      columns: [
      {data: 'Details', name: 'Details'},
      {data: 'Status', name: 'Status'},
      {data: 'Remarks', name: 'Remarks'},
      ]
    });
}
</script>