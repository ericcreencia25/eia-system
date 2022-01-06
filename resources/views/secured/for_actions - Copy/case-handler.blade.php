@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>For Action</a></li>
        </ol>
    </section>
@stop

@section('content')

    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="box box-default">
          <div class="box-header with-border">
            <div class="col-md-9">
              <img id="" src="../img/doc1.jpg" style="width:38px;"><h1 class="box-title"><b>Applications for Action   -  </b></h1>
            </div>
            <div class="col-md-3">
              <!-- <div class="form-group"> -->
                <label>Date range:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation">
                </div>
                <!-- /.input group -->
              <!-- </div> -->
            </div>
            
          </div>
          <div class="box-body">
          <div class="box-header">
                Listed below are the ECC Applications pending with you for appropriate action. Click the project name/address to load the application.
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-bordered" id="CaseHandlerForActionTable" style="width: 100%;  display: table; table-layout: fixed;">
                  <thead>
                      <th style="width: 35%">Details</th>
                      <th style="width: 20%">Status</th>
                      <th style="width: 35%">Remarks</th>
                      <th style="width: 10%">Total days incurred to date </th>
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
  var now = moment().format("YYYY/MM/DD");
  var start_date = now;
  var end_date = now;

  var date = new Date(), y = date.getFullYear(), m = date.getMonth();

  //get First day of the current month
  var firstDay = new Date(y, m, 1);
  var FirstDate = getDateFormat(firstDay);

  //get Last day of the current month
  var lastDay = new Date(y, m + 1, 0);
  var LastDate = getDateFormat(lastDay);

  $('#CaseHandlerForActionTable').DataTable({
    destroy : true,
    processing:true,
    info:true,
    order: false,
    ajax: {
      "url": "{{route('getCaseHandlerForActionsTable')}}",
      "type": "POST",
      "data": {
        UserName : UserName,
        UserRole : UserRole,
        UserOffice : UserOffice,
        StartDate : FirstDate,
        EndDate : LastDate,
        _token: '{{csrf_token()}}' ,
      },
    },
    columns: [
    {data: 'Details', name: 'Details'},
    {data: 'Status', name: 'Status'},
    {data: 'Remarks', name: 'Remarks'},
    {data: 'IncurredDate', name: 'IncurredDate'},
    ]
  });


  $('#reservation').daterangepicker({
    maxSpan: {"days":31},
    locale : { format: 'YYYY-MM-DD' },
    startDate : FirstDate,
    endDate: LastDate
  }, function(start,end,label){
    start_date = start.format('YYYY-MM-DD');
    end_date =  end.format('YYYY-MM-DD');
  });

  $('#reservation').on('change', function() {
    var date_filter = $('#reservation').val();
    var date_filter_split = date_filter.split(" - ");
    var sd = date_filter_split[0];
    var ed = date_filter_split[1];

    $('#CaseHandlerForActionTable').DataTable({
      destroy : true,
      processing:true,
      info:true,
      order: false,
      ajax: {
        "url": "{{route('getCaseHandlerForActionsTable')}}",
        "type": "POST",
        "data": {
          UserName : UserName,
          UserRole : UserRole,
          UserOffice : UserOffice,
          StartDate : sd,
          EndDate : ed,
          _token: '{{csrf_token()}}' ,
        },
      },
      columns: [
      {data: 'Details', name: 'Details'},
      {data: 'Status', name: 'Status'},
      {data: 'Remarks', name: 'Remarks'},
      {data: 'IncurredDate', name: 'IncurredDate'},
      ]
    });
  });
});


function getDateFormat(FilterDate)
{
  var dd = String(FilterDate.getDate()).padStart(2, '0');
  var mm = String(FilterDate.getMonth() + 1).padStart(2, '0');
  var yyyy = FilterDate.getFullYear();

  return yyyy + '/' + mm + '/' + dd;
}

</script>