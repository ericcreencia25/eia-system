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
      <h5 class="card-title m-0"><img id="" src="../img/personlock.jpg" style="width:38px;"> <b>Manage Signatories </b>
      </h5>
    </div>
    <div class="card-body">
      <div class="row">
        <small>This module is for system administrator only.</small>
        <table id="Signatories" class="table">
          <thead>
            <tr>
              <th>Alias</th>
              <th>Address</th>
              <th>EIAChief</th>
              <th>Director</th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="RegionalInformation">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">
        <h4 class="modal-title" id="regional-title">Regional Information:</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-sm-8">
            <label for="exampleInputEmail1">Address</label>
            <input type="text" class="form-control" id="Address" placeholder="Address">
          </div>
          <div class="form-group col-sm-4">
            <label for="exampleInputEmail1">Telephone No.</label>
            <input type="text" class="form-control" id="TelephoneNo" placeholder="Telephone No.">
          </div>
          <div class="form-group col-sm-4">
            <label for="exampleInputEmail1">FaxNo</label>
            <input type="text" class="form-control" id="FaxNo" placeholder="FaxNo">
          </div>
          <div class="form-group col-sm-4">
            <label for="exampleInputEmail1">Email Address</label>
            <input type="text" class="form-control" id="EmailAddress" placeholder="Email Address">
          </div>
          <div class="form-group col-sm-4">
            <label for="exampleInputEmail1">Website</label>
            <input type="text" class="form-control" id="Website" placeholder="Website">
          </div>
          <div class="form-group col-sm-4">
            <label for="exampleInputEmail1">Recommending Officer</label>
            <input type="text" class="form-control" id="EIAChief" placeholder="Recommending Officer">
          </div>
          <div class="form-group col-sm-8">
            <label for="exampleInputFile">Recommending Officer Signature (1x1 png)</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <label for="exampleInputEmail1">Approving Officer</label>
            <input type="text" class="form-control" id="Director" placeholder="Approving Officer">
          </div>
          <div class="form-group col-sm-4">
            <label for="exampleInputEmail1">Designation</label>
            <input type="text" class="form-control" id="Designation" placeholder="Designation">
          </div>
          <div class="form-group col-sm-4">
            <label for="exampleInputFile">Approving Officer Signature (1x1 png)</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
  Signatories();

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

});

function Signatories()
{
  $('#Signatories').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "responsive": true,
    "destroy" : true,
    lengthMenu: [100, 200],
    ajax: {
      "url": "{{route('getSignatories')}}",
      "type": "GET",
    },
    columns: [
    {data: 'Region', name: 'Region'},
    {data: 'Address', name: 'Address'},
    {data: 'EIAChief', name: 'EIAChief'},
    {data: 'Director', name: 'Director'},
    {data: 'Action', name: 'Action'},
    ],
    language: 
    {
      'loadingRecords': '&nbsp;',
      'processing': '<div class="spinner"></div>Processing...'
    }
  });
}

function regionalInfo(GUID)
{
  $.ajax({
    url: "{{route('getRegionalInformation')}}",
    type: 'POST',
    data: {
      GUID : GUID,
      _token: '{{csrf_token()}}' ,
    },  
    success: function(response){
      $("#regional-title").html('Regional Information: ' + response['Region']);
      $("#Address").val(response['Address']);
      $("#TelephoneNo").val(response['TelephoneNo']);
      $("#EmailAddress").val(response['EmailAddress']);
      $("#Website").val(response['Website']);
      $("#EIAChief").val(response['EIAChief']);        
      $("#Director").val(response['Director']);
      $("#Designation").val(response['Designation']);
    }
  });

  $("#RegionalInformation").modal('show');
}
</script>
