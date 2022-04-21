@extends('layouts.adminlte.default.layout-admin-3')
  

@section('header')
<!-- <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>Manage Credentials</a></li>
        </ol>
    </section> -->
@stop




@section('content')
<div class="content">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title m-0"><img id="" src="../img/personlock.jpg" style="width:38px;"> <b>Manage Credentials </b></h5>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="input-group col-sm-3">
          <select class="custom-select form-control-border" id="office" placeholder="Region">
            <option value="">Region</option>
          </select>
        </div>
        <div class="input-group col-sm-3">
          <select class="custom-select form-control-border" id="exampleSelectBorder" placeholder="Office">
            <option>Office</option>
            <option>EIAMD Division</option>
            <option>Office of the Regional Director</option>
            <option>Permitting and Clearance Division</option>
            <option>Monitoring and Enforcement Division</option>
            <option>Administrative and Finance Division</option>
          </select>
        </div>
        <div class="input-group col-sm-1">
          <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Title">
        </div>
        <div class="input-group col-sm-2">
          <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Full Name">
        </div>
        <div class="input-group col-sm-3">
          <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Position">
        </div>

        <div class="col-sm-3">
          <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Birth Date (MM/DD/YYYY)">
        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Mobile No.">
        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Email Address">
        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Role">
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="row">
        <table id="RegisteredUsers" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Status</th>
              <th>User Name</th>
              <th>Role</th>
              <th>Email Address </th>
              <th>Birth Date </th>
              <th>Last Activity Date </th>
              <th>In ECC </th>
              <th>Receiver</th>
              <th>In CNC</th>
              <th>Receiver</th>
              <th>In CMR </th>
              <th>Receiver</th>
            </tr>
          </thead>
        </table>
      </div>
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
var UserOffice = "{{session('data')['UserOffice']}}";
var UserName = "{{session('data')['UserName']}}";
var UserRole = "{{session('data')['UserRole']}}";

$(function (){

  // $("input[data-bootstrap-switch]").each(function(){
  //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
  //   })

  // $('#InECCOAS').on('switchChange', function() {
  //   // alert ("The element with id " + this.id + " changed.");
  //   alert('dsadsadsa');
  // });

  // $('#InECCOAS').change(function() {
  //     $('#console-event').html('Switch-Button: ' + $(this).prop('checked'))
  //   })
  $("#InECCOAS").bootstrapSwitch();
  $('#InECCOAS').on('switchChange.bootstrapSwitch', function (e, data) {
   
    alert('ssa');

});

  RegisteredUsers($("#office :selected").val());

  $.ajax({
    url: "{{route('getOffice')}}",
    type: 'GET',
    success: function(response){
      $.each(response, function(index, value ) {
        var option = "<option value='"+value['Location']+"'>"+value['Location']+"</option>";
        $("#office").append(option); 
      });
    }
  });

  $("#office").on("change", function() {
    RegisteredUsers($("#office :selected").val());
  });
});


function RegisteredUsers(office)
{
  $('#RegisteredUsers').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "destroy" : true,
    ajax: {
      "url": "{{route('getRegisteredUsers')}}",
      "type": "POST",
      "data": {
        UserOffice : UserOffice,
        OfficeSelect : office, 
        _token: '{{csrf_token()}}' ,
      },
    },
    columns: [
    {data: 'Status', name: 'Status'},
    {data: 'UserName', name: 'UserName'},
    {data: 'Role', name: 'Role'},
    {data: 'Email', name: 'Email'},
    {data: 'BirthDate', name: 'BirthDate'},
    {data: 'LastActivityDate', name: 'LastActivityDate'},
    {data: 'InECCOAS', name: 'InECCOAS'},
    {data: 'DefaultRecipient', name: 'DefaultRecipient'},
    {data: 'InCNCOAS', name: 'InCNCOAS'},
    {data: 'DefaultRecipientCNC', name: 'DefaultRecipientCNC'},
    {data: 'InCMROS', name: 'InCMROS'},
    {data: 'DefaultRecipientCMR', name: 'DefaultRecipientCMR'},
    ],
    language: 
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
}

function checkbox(num, description)
{
  alert(num + ' ' + description);
}
</script>
