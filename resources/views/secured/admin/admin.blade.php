@extends('layouts.adminlte.default.layout-admin-3')


@section('header')

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

<div class="modal fade" id="modal-user-action">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">
        <h4 class="modal-title" id="username"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="UserStatusTable" >
          <thead style=" background-color: #f5f6f8">
            <th width="60%">Action</th>
            <th width="10%">Active</th>
            <th width="10%">ECC</th>
            <th width="10%">CMR</th>
            <th width="10%">CNC</th>
          </thead>
          <tbody >
          </tbody>
          <tfoot>
            <tr>
              <th>
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Add</button>
                  </span>
                </div>
              </th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label>User Status</label>
              <input type="text" class="form-control" id="UserStatus" placeholder="status" disabled>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label>Role</label>
              <select class="form-control select2" style="width: 100%;" id="UserRole">
                <option selected="selected" value="Evaluator">Evaluator (Casehandler)</option>
                <option value="Reviewer">Reviewer (Section Chief)</option>
                <option value="Recommending">Recommending (Division Chief)</option>
                <option value="Recommending (CMR)">Recommending (CMR)</option>
                <option value="Approving">Approving</option>
                <option value="Approving (CMR)">Approving (CMR)</option>
                <option value="Executive">Executive</option>
              </select>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Office</label>
              <select class="form-control select2" style="width: 100%;" id="UserOffice">
                <option selected="selected" value="CAR">CAR</option>
                <option value="CO">CO</option>
                <option value="NCR">NCR</option>
                <option value="R01">R01</option>
                <option value="R02">R02</option>
                <option value="R03">R03</option>
                <option value="R05">R05</option>
                <option value="R06">R06</option>
                <option value="R07">R07</option>
                <option value="R08">R08</option>
                <option value="R09">R09</option>
                <option value="R10">R10</option>
                <option value="R11">R11</option>
                <option value="R12">R12</option>
                <option value="R13">R13</option>
                <option value="R18">R18</option>
                <option value="R4A">R4A</option>
                <option value="R4B">R4B</option>
                <option value="Proponent">Proponent</option>
              </select>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default">Update Role</button>
        <button type="button" class="btn btn-default">Reset Password</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
      "ordering": false,
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

  function StatusModal(user)
  {
    $("#username").html(user.toUpperCase());

    $('#UserStatusTable').DataTable({
      "destroy" : true,
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      "ajax": {
        "url": "{{route('getUserAction')}}",
        "type": "POST",
        "data": {
          UserName : user,
          _token: '{{csrf_token()}}' ,
        },
      },
      "columns": [
      {data: 'Action', name: 'Action'},
      {data: 'Active', name: 'Active'},
      {data: 'ECC', name: 'ECC'},
      {data: 'CMR', name: 'CMR'},
      {data: 'CNC', name: 'CNC'},

      ],
      "language": 
      {
        'loadingRecords': '&nbsp;',
        'processing': '<div class="spinner"></div>Processing...'
      }
    });

    $.ajax({
      url: "{{route('UserStatusModal')}}",
      type: 'POST',
      data: {
        user : user,
        _token: '{{csrf_token()}}',
      },
      success: function(response){
        if(response['IsApproved'] == 1){
          var Status = 'Active';
        }else{
          var Status = 'Inactive';
        }
        $("#UserStatus").val(Status);
        $("#UserRole").val(response['UserRole']);
        $("#UserOffice").val(response['UserOffice']);
      }
    }); 

    $('#modal-user-action').modal();
  }

  function checkbox(num, description)
  {
    alert(num + ' ' + description);
  }
</script>
