@extends('layouts.adminlte.default.layout-admin-3')

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title m-0"><img id="" src="../img/personlock.jpg" style="width:38px;"> <b>Applications Currently with {{ Str::upper($req['Username']) }}</b></h5>
    </div>
    <div class="card-body">
      <!-- <div class="row"> -->
        <table id="getUserApplicationsTable" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th width="60%">Details</th>
              <th width="20%">Representative</th>
              <th width="20%">ECC Reference No.</th>
            </tr>
          </thead>
        </table>
      <!-- </div> -->
    </div>
  </div>
</div>

@stop

<script src="../../adminlte-3.1.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../adminlte-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../adminlte-3.1.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/jszip/jszip.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../adminlte-3.1.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte-3.1.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../adminlte-3.1.0/dist/js/demo.js"></script> -->

<!-- Bootstrap Switch -->
<script src="../../adminlte-3.1.0/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


<script>

var UserName = "{{$req['Username']}}";

$(function (){
  $('#getUserApplicationsTable').DataTable({
    "destroy" : true,
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": true,
    "responsive": true,
    "ajax": {
      "url": "{{route('getUserApplicationsTable')}}",
      "type": "POST",
      "data": {
        UserName : UserName,
        _token: '{{csrf_token()}}' ,
      },
    },
    "columns": [
    {data: 'Details', name: 'Details'},
    {data: 'Representative', name: 'Representative'},
    {data: 'ECCNumber', name: 'ECCNumber'},
    ],
    "language": 
    {
      'loadingRecords': '&nbsp;',
      'processing': '<div class="spinner"></div>Processing...'
    },
    "fnDrawCallback": function() {
      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })
    },
  });

});


</script>
