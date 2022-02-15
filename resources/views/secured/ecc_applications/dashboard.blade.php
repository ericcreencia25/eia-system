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
  .pointer {
    cursor: pointer;
  }

  .blink_img {
    animation: blinker 1s linear infinite;
  }
  
  @keyframes blinker {
    50% { opacity: 0; }
  }
  @keyframes blin {
    50% { opacity: 0; }
  }
</style>

@section('content')
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="box">
          <div class="box-header with-border">
            <label style="font-size: 15px;">ECC APPLICATIONS WITH {{ Session::get('data')['UserOffice']}} ---- Data as of {{ $todate}}         </label>
            <label class="pull-right" style="font-size: 13px;">
              Next Page Refresh on {{ $NextRefresh }}
            </label>
          </div>
          <div class="box-body">
              <div class="box-header"></div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="col-md-12 no-padding">

                  <!---left-->
                  <div class="col-md-3 no-padding">
                    <!-- <div class="box"> -->
                      <div class="box-header" style="background-color:whitesmoke; color:gray; padding:5px;">
                        <label class="box-title" style="font-size: 14px;padding-left: 0px;">Under Process ECC Applications per Status</label>
                      </div>
                      <div class="box-body no-padding">
                        <table class="table table-condensed">
                          <thead style="padding:0px;font-size: 14px;">
                            <th style="width: 50px; ">Status</th>
                            <th style="width: 25px">Pending</th>
                            <th style="width: 25px">Beyond</th>
                          </thead>
                          <tbody id="under_process_ecc_per_status">
                          </tbody>
                        </table>
                      </div>

                      <div class="box-header" style="background-color:whitesmoke; color:gray; padding:5px;">
                        <label class="box-title" style="font-size: 14px;padding-left: 0px;">Under Process ECC Applications per Location</label>
                      </div>
                      <div class="box-body no-padding">
                        <table class="table table-condensed">
                          <thead style="padding:0px;font-size: 14px;">
                            <th style="width: 50px">Personnel</th>
                            <th style="width: 25px">Pending</th>
                            <th style="width: 25px">Beyond</th>
                          </thead>
                          <tbody>
                        </tbody></table>
                      </div>

                      <div class="box-header"  style="background-color:whitesmoke; color:gray; padding:5px;">
                        <label class="box-title" style="font-size: 14px;padding-left: 0px;">2022 Applications Statisitcs</label>
                      </div>
                      <div class="box-body no-padding">
                        <table class="table table-condensed">
                          <thead style="padding:0px;font-size: 14px;">
                          <th style="width: 50px">Month</th>
                          <th style="width: 25px">Applications</th>
                          <th style="width: 25px">Approved</th>
                          <th style="width: 25px">Denied</th>
                        </thead>
                        <tbody>
                        </tbody></table>
                      </div>

                  </div>


                  <!---middle-->
                  <div class="col-md-6 no-padding">

                    <div class="box-header">
                        <label class="box-title" style="background-color:whitesmoke; color:gray; padding:5px;font-size: 14px;">Under Process ECC Applications - 44, Beyond 20 days from last submission - 1</label>
                      </div>
                      <div class="box-body no-padding">
                        <table class="table" id="under_process_ecc_application">
                          <thead>
                            <th style="width: 10px"></th>
                            <th></th>
                          </thead>
                          <tbody>
                        </tbody></table>
                      </div>

                  </div>

                  <!---right-->
                  <div class="col-md-3 no-padding">
                    <div class="box-header">
                      <label class="box-title" style="background-color:whitesmoke; color:gray; padding:5px;font-size: 14px;">Applications Decided for Past 30 days - 19</label>
                    </div>
                    <div class="box-body no-padding">
                      <table class="table table-condensed" id="applications_decided_for_past_30_days">
                        <thead>
                          <th></th>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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

  $('#under_process_ecc_application').DataTable({
    processing:true,
    info:true,
    searching: false,
    ordering: false,
    bPaginate: true,
    bLengthChange: false,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    ajax: {
      "url": "{{route('getUnderProcessECCApplication')}}",
      "type": "POST",
      "data": {
        UserName : UserName,
        UserRole : UserRole,
        UserOffice : UserOffice,
        _token: '{{csrf_token()}}' ,
      },
    },
    columns: [
    {data: 'Color', name: 'Color'},
    {data: 'Details', name: 'Details'},
    ]
  });

  $('#applications_decided_for_past_30_days').DataTable({
      processing:true,
      info:false,
      searching: false,
      ordering: false,
      bPaginate: false,
      bLengthChange: false,
      bFilter: false,
      bInfo: false,
      bAutoWidth: false,
      ajax: {
        "url": "{{route('getApplicationsDecided')}}",
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
      ]
    });

    $.ajax({
      url: "{{route('getUnderProcessPerStatus')}}",
        type: 'POST',
        data: {
          UserOffice : UserOffice,
          UserRole : UserRole,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          $.each(response, function(index, value ) {
            var details = '<tr>';
            details += '<td>' + value['Status'] + '</td>';
            details += '<td>' + value['Pending'] + '</td>';  

          $("#under_process_ecc_per_status").append(details);
          });

          
        }
      });
  });
</script>