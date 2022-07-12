@extends('layouts.adminlte.default.layout-admin-3')

@section('content')
<div class="content">

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 20px">Basic Project Information</label>
    </div>

    <form class="form-horizontal">
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Project Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="ProjectName" placeholder="Project Name" value="{{ $Project->ProjectName}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Location</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Address" placeholder="Address" value="{{ $Project->Address}}">
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="Municipality" placeholder="Municipality" value="{{ $Project->Municipality}}">
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" id="Province" placeholder="Province" value="{{ $Project->Province}}">
          </div>
          <div class="col-sm-1">
            <input type="text" class="form-control" id="Region" placeholder="Region" value="{{ $Project->Region}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Representative</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="Representative" placeholder="Representative" value="{{ $Project->Representative}}" >
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Designation</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="Designation" placeholder="Designation" value="{{ $Project->Designation}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Reference No </label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="ReferenceNo" placeholder="ReferenceNo" value="{{ $Project->ReferenceNo}} ({{ $Project->Purpose}})" disabled>
          </div>
          <span class="col-sm-5 col-form-label"><small>Accepted On {{date("m/d/Y h:i:s A", strtotime($Project->AcceptedDate))}} by {{ $Project->AcceptedBy}} - Accumulated {{ $Project->TotProcDays}}/{{ $Project->ProcTimeFrameInDays}} days</small></span>

          <button type="button" class="btn btn-block btn-primary btn-sm col-sm-2">Update</button>
        </div>

      </div>
    </form>
  </div>

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 17px">Payment Information</label>
    </div>

    <form class="form-horizontal">
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-1 col-form-label">Bank Branch</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="ProjectName" placeholder="Bank Branch" value="{{ $Project->BankBranch}}">
          </div>

          <label for="inputEmail3" class="col-sm-1 col-form-label">OR Number</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="ProjectName" placeholder="OR Number" value="{{ $Project->ORNumber}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-1 col-form-label">Date Paid</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="ProjectName" placeholder="Date Paid" value="{{ $Project->BankTransaction}}">
          </div>

          <label for="inputEmail3" class="col-sm-1 col-form-label">Processing Fee</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="ProjectName" placeholder="Processing Fee" value="{{ $Project->ProcessingFee}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-1 col-form-label">Amount Paid</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="Representative" placeholder="Amount Paid" value="{{ $Project->AmountPaid}}">
          </div>
          <div class="col-sm-4"></div>
          <button type="button" class="btn btn-block btn-primary btn-sm col-sm-2">Update</button>
        </div>
      </div>
    </form>
  </div>

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 20px">Project Type</label>
    </div>

    <div class="card-body">
      <table id="getProjectTypeAdmin" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th width="20%">Project Type</th>
            <th width="30%">Project Sub Type</th>
            <th width="20%">Specific Type</th>
            <th width="10%">Specific Sub Type</th>
            <th width="10%">Parameter</th>
            <th width="5%">Unit of Measure</th>
            <th width="5%">Report Type</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 20px">User Account/s</label>
    </div>

    <div class="card-body">
      <table id="getUserAccountsAdmin" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th width="20%">Login Name  </th>
            <th width="10%">Designation</th>
            <th width="15%">Email</th>
            <th width="15%">BirthDate</th>
            <th width="10%">Mobile No </th>
            <th width="10%">GovernmentID</th>
            <th width="10%">Authorization</th>
            <th width="10%">SEC/DTI Registration</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 20px">Proponent Information</label>
    </div>

    <form class="form-horizontal">
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Proponent</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="ProjectName" placeholder="Proponent" value="{{ $Project->ProponentName}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Mailing Address</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="ProjectName" placeholder="Mailing Address" value="{{ $Project->MailingAddress}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Contact Person</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Representative" placeholder="Contact Person" value="{{ $Project->ContactPerson}}">
          </div>
          <label for="inputEmail3" class="col-sm-2 col-form-label">Designation</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Representative" placeholder="Designation" value="{{ $Project->Designation}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Contact No.  </label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Representative" placeholder="Contact No."  value="{{ $Project->ContactPersonNo}}">
          </div>
          <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile No.</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Representative" placeholder="Mobile No." value="{{ $Project->MobileNo}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email Address  </label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Representative" placeholder="Email Address  " value="{{ $Project->ContactPersonEmailAddress}}">
          </div>
          <label for="inputEmail3" class="col-sm-2 col-form-label">Line Of Business </label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Representative" placeholder="Line Of Business " value="{{ $Project->LineOfBusiness}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">SEC Registration No. </label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Representative" placeholder="SEC Registration No." value="{{ $Project->SECRegistrationNo}}">
          </div>
          <label for="inputEmail3" class="col-sm-2 col-form-label">DTI Registration No. </label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Representative" placeholder="DTI Registration No. " value="{{ $Project->DTIRegistrationNo}}">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10"></div>
          <button type="button" class="btn btn-block btn-primary btn-sm col-sm-2">Update</button>
        </div>

      </div>
    </form>
  </div>

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 20px">Attachments and Certificates</label>
    </div>

    <div class="card-body">
      <table id="getAttachmentsAdmin" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>Timestamp</th>
            <th>Description</th>
            <th></th>
            <!-- <th></th> -->
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 20px">Routing History</label>
    </div>

    <div class="card-body">
      <table id="getRoutingHistoryAdmin" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>TimeStamped</th>
            <th>RoutedFrom</th>
            <th>From Office</th>
            <th>RoutedTo</th>
            <th>To Office</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 20px">Requirements</label>
    </div>

    <div class="card-body">
      <table id="getRequirementsAdmin" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>Compliant</th>
            <th>Required</th>
            <th>Description</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!----->

  <div class="card card-default">
    <div class="card-header">
      <label class="card-title" style="font-size: 20px">Processing Time</label> * Weekend and holidays not included
    </div>

    <div class="card-body">
      <table id="getProcessingTimeAdmin" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>TimeStamped</th>
            <th>RoutedFrom</th>
            <th>RoutedTo</th>
            <th>Status/Details</th>
            <th>Accumulated Days</th>
            <th></th>
          </tr>
        </thead>
      </table>
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

<!-- dropzonejs -->
<script src="../../adminlte-3.1.0/plugins/dropzone/min/dropzone.min.js"></script>

<script src="../../adminlte-3.1.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- AdminLTE App -->
<script src="../../adminlte-3.1.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../adminlte-3.1.0/dist/js/demo.js"></script> -->

<!-- Bootstrap Switch -->
<script src="../../adminlte-3.1.0/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


<script>
  var ProjectGUID = '{{ $Project->ProjectGUID}}';
  var ComponentGUID = '{{ $Project->ComponentGUID}}';
  var Representative = '{{ $Project->CreatedBy}}';

$(function (){

  bsCustomFileInput.init();

  $('#getProjectTypeAdmin').DataTable({
    "destroy" : true,
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive": true,
    "ajax": {
      "url": "{{route('getProjectTypeAdmin')}}",
      "type": "POST",
      "data": {
        ComponentGUID : ComponentGUID,
        _token: '{{csrf_token()}}' ,
      },
    },
    "columns": [
    {data: 'ProjectType', name: 'ProjectType'},
    {data: 'ProjectSubType', name: 'ProjectSubType'},
    {data: 'ProjectSpecificType', name: 'ProjectSpecificType'},
    {data: 'ProjectSpecificSubType', name: 'ProjectSpecificSubType'},
    {data: 'Parameter', name: 'Parameter'},
    {data: 'UnitOfMeasure', name: 'UnitOfMeasure'},
    {data: 'ReportType', name: 'ReportType'},
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

  $('#getUserAccountsAdmin').DataTable({
    "destroy" : true,
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive": true,
    "ajax": {
      "url": "{{route('getUserAccountsAdmin')}}",
      "type": "POST",
      "data": {
        Representative : Representative,
        _token: '{{csrf_token()}}' ,
      },
    },
    "columns": [
    {data: 'UserName', name: 'UserName'},
    {data: 'Designation', name: 'Designation'},
    {data: 'Email', name: 'Email'},
    {data: 'BirthDate', name: 'BirthDate'},
    {data: 'MobileNo', name: 'MobileNo'},
    {data: 'GovernmentID', name: 'GovernmentID'},
    {data: 'AuthorizationLetter', name: 'AuthorizationLetter'},
    {data: 'SecDTIRegistration', name: 'SecDTIRegistration'},

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

  $('#getAttachmentsAdmin').DataTable({
    "destroy" : true,
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive": true,
    "ajax": {
      "url": "{{route('getAttachmentsAdmin')}}",
      "type": "POST",
      "data": {
        ProjectGUID : ProjectGUID,
        _token: '{{csrf_token()}}' ,
      },
    },
    "columns": [
    {data: 'Timestamp', name: 'Timestamp'},
    {data: 'Description', name: 'Description'},
    // {data: 'Input', name: 'Input'},
    {data: 'Upload', name: 'Upload'},

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
  
  $('#getRoutingHistoryAdmin').DataTable({
    "destroy" : true,
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive": true,
    "ajax": {
      "url": "{{route('getRoutingHistoryAdmin')}}",
      "type": "POST",
      "data": {
        ProjectGUID : ProjectGUID,
        _token: '{{csrf_token()}}' ,
      },
    },
    "columns": [
    {data: 'Timestamp', name: 'Timestamp'},
    {data: 'RoutedFrom', name: 'RoutedFrom'},
    {data: 'FromOffice', name: 'FromOffice'},
    {data: 'RoutedTo', name: 'RoutedTo'},
    {data: 'ToOffice', name: 'ToOffice'},

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

  $('#getRequirementsAdmin').DataTable({
    "destroy" : true,
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive": true,
    "ajax": {
      "url": "{{route('getRequirementsAdmin')}}",
      "type": "POST",
      "data": {
        ProjectGUID : ProjectGUID,
        _token: '{{csrf_token()}}' ,
      },
    },
    "columns": [
    {data: 'Compliant', name: 'Compliant'},
    {data: 'Required', name: 'Required'},
    {data: 'Description', name: 'Description'},

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

  $('#getProcessingTimeAdmin').DataTable({
    "destroy" : true,
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive": true,
    "ajax": {
      "url": "{{route('getProcessingTimeAdmin')}}",
      "type": "POST",
      "data": {
        ProjectGUID : ProjectGUID,
        _token: '{{csrf_token()}}' ,
      },
    },
    "columns": [
    {data: 'Timestamp', name: 'Timestamp'},
    {data: 'RoutedFrom', name: 'RoutedFrom'},
    {data: 'RoutedTo', name: 'RoutedTo'},
    {data: 'Status', name: 'Status'},
    {data: 'AccumulatedDays', name: 'AccumulatedDays'},

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

function uploadFile(description, id, ActivityGUID)
{
  var input_id = "#files_" + id;

  // Get the selected file
  var files = $(input_id)[0].files;

  if(files.length > 0){
    var fd = new FormData();

    // Append data
    fd.append('id', id);
    fd.append('description', description);
    fd.append('ActivityGUID', ActivityGUID);
    fd.append('ProjectGUID', ProjectGUID);
    fd.append('file',files[0]);
    fd.append('_token','{{csrf_token()}}');

    // Hide alert
    $('#responseMsg').hide();

    Swal.fire({
      title: 'Are you sure?',
      text: "You want to upload this file",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm',
      width: '550px',
      height: '400px',
    }).then((result) => {
      if (result.isConfirmed) {
        // $("#modal-default").modal('show');
        // AJAX request
        $.ajax({
          url: "{{route('adminUploadFile')}}",
          method: 'post',
          data: fd,
          contentType: false,
          processData: false,
          dataType: 'json',
          xhr: function() {
            var xhr = new window.XMLHttpRequest();

            xhr.upload.addEventListener('progress', function(e) {
              if (e.lengthComputable) {
                console.log('Bytes Loaded: ' + e.loaded);
                console.log('Total Size: ' + e.total);
                console.log('Percentage Uploaded: ' + (e.loaded / e.total));

                var percent = Math.round((e.loaded / e.total) * 100);
                console.log(percent);
                $('#progressBar_' + id).attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
              }
            });

            return xhr;

          },
          success: function(response){

            if(response['success'] == 1){

              Swal.fire({
                icon: 'success',
                title: response['message'],
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'Confirm',
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.dismiss || result.isConfirmed) {
                  location.reload();
                } else if (result.isDenied) {
                  Swal.fire('Changes are not saved', '', 'info')
                }
              })
            } else {
              alert("error : " + JSON.stringify(response['error']) );
            }
          },
          error: function(response){
            alert("error : " + JSON.stringify(response) );
          }
        });
      }
    })
  }else{
    Swal.fire({
      icon: 'warning',
      title: 'Please select a file.',
      showConfirmButton: false,
      timer: 1300,
      width: '500px',
      height: '400px',
    });
  }
}



</script>
