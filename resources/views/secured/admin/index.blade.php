@extends('layouts.adminlte.default.layout-admin')
  

@section('header')
<section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>Manage Credentials</a></li>
        </ol>
    </section>
@stop




@section('content')

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container-fluid">

    <div class="box box-default">
      <div class="box-header with-border">
        <img id="" src="../img/personlock.jpg" style="width:38px;"> <b>Manage Credentials </b>
      </div>
      <div class="box-body">
        <div class="box-header">
          Add New User
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="col-md-12">
            <div class="col-md-3 no-padding">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Region</label>
                  <select class="form-control" id="office">
                    <option value=""></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Birth Date (MM/DD/YYYY)</label>
                  <input type="text" class="form-control" id="emb_id" placeholder="Birth Date">
                </div>
              </div>
            </div>
            <div class="col-md-3 no-padding">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Office</label>
                  <select class="form-control">
                    <option></option>
                    <option>EIAMD Division</option>
                    <option>Office of the Regional Director</option>
                    <option>Permitting and Clearance Division</option>
                    <option>Monitoring and Enforcement Division</option>
                    <option>Administrative and Finance Division</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Mobile No.</label>
                  <input type="text" class="form-control" id="emb_id" placeholder="Mobile No.">
                </div>
              </div>
            </div>
            <div class="col-md-3 no-padding">
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Title">
                </div>
                <div class="form-group col-md-8">
                  <label for="exampleInputPassword1">Full Name (User Name)</label>
                  <input type="text" class="form-control" id="full_name" placeholder="Full Name">
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleInputPassword1">Email Address</label>
                  <input type="text" class="form-control" id="email" placeholder="Email">
                </div>
              </div>
            </div>
            <div class="col-md-3 no-padding">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Position</label>
                  <input type="text" class="form-control" id="company_name" placeholder="Position">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Role</label>
                  <select class="form-control">
                    <option></option>
                    <option>Approving</option>
                    <option>Approving (CMR)</option>
                    <option>Evaluator</option>
                    <option>Executive</option>
                    <option>Recommending</option>
                    <option>Recommending (CMR)</option>
                    <option>Reviewer</option>
                    <option>Viewer</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 no-padding">
            <table class="table table-bordered" id="RegisteredUsers" >
              <thead style=" background-color: #f5f6f8">
                <th>Status</th>
                <th>User Name</th>
                <th>Role</th>
                <th>Email Address</th>
                <th>Birth Date</th>
                <th>Last Activity Date</th>
                <th>In ECC </th>
                <th>Receiver</th>
                <th>In CNC</th>
                <th>Receiver</th>
                <th>In CMR</th>
                <th>Receiver</th>
              </thead>
              <tbody></tbody>
            </table>
          </div>
          <!-- <input type="text" id="searchInput" placeholder="Type Keywords..."> -->
          
        </div>
      </div>
    </div>

  </section>
</div>

<div class="modal fade" id="modal-user-action">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title" id="username"></h5>
        </div>
        <div class="modal-body">
          <!-- <div class="col-md-12 no-padding"> -->
            <table class="table table-bordered" id="UserStatusTable" style="width: 100%;border-collapse:collapse;" >
              <thead style=" background-color: #f5f6f8">
                <th style="width: 60px">Action</th>
                <th style="width: 10px">Active</th>
                <th style="width: 10px">ECC</th>
                <th style="width: 10px">CMR</th>
                <th style="width: 10px">CNC</th>
              </thead>
              <tbody></tbody>
            </table>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- <input type="checkbox" name="checkbox1"> -->

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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script> -->

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

<script src="../../adminlte/dist/js/bootstrap-switch.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyB6K1CFUQ1RwVJ-nyXxd6W0rfiIBe12Q&libraries=places" type="text/javascript"></script>

<!-- iCheck 1.0.1 -->
<script src="../../adminlte/plugins/iCheck/icheck.min.js"></script>

<script>
var UserOffice = "{{session('data')['UserOffice']}}";
var UserName = "{{session('data')['UserName']}}";
var UserRole = "{{session('data')['UserRole']}}";

$(document).ready(function(){
  ResetSession();
  localStorage.clear();
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
      _token: '{{csrf_token()}}',
    },
    success: function(response){
      document.location = href + result;
    }
  }); 
}

function checkbox(num, description)
{

  // $("input[name="+description+"]").click(function(){
    var checked = $("input[name="+description+"]").is(':checked');
    if(checked) {
        if(!confirm('Are you sure you want to resume use of this program?')){         
          $("input[name="+description+"]").prop('checked', false);
          $("input[name="+description+"]").removeAttr("onclick");
          $("input[name="+description+"]").attr("onclick", "checkbox(1,\'InECCOAS\' )");
        }
    } else{
      if(!confirm('Are you sure you want to discontinue this program?')){
        $("input[name="+description+"]").prop('checked', true);
        $("input[name="+description+"]").removeAttr("onclick");
        $("input[name="+description+"]").attr("onclick", "checkbox(0,\'InECCOAS\' )");
      }
    }
// }
// );

  // Swal.fire({
  //   title: 'Do you want to toggle default ECC receiver?',
  //   showDenyButton: true,
  //   showCancelButton: false,
  //   confirmButtonText: 'Save',
  //   denyButtonText: `Don't save`,
  // }).then((result) => {
  //   /* Read more about isConfirmed, isDenied below */
  //   if (result.isConfirmed) {
      
  //   } else if (result.isDenied) {
  //     Swal.fire('Changes are not saved', '', 'info')
  //     $("input[name="+description+"]").prop('checked', false);
  //       $("input[name="+description+"]").removeAttr("onclick");
  //       $("input[name="+description+"]").attr("onclick", "checkbox("+num+",\'InECCOAS\' )");
  //   }
  // })

  
  
}

function StatusModal(user)
{
  $('#UserStatusTable').DataTable({
    destroy: true,
    processing:true,
    info:false,
    ordering: false,
    scrollY: 400,
    deferRender: false,
    scroller:false,
    searching : false,
    bLengthChange: false,
    ajax: {
      "url": "{{route('getUserAction')}}",
      "type": "POST",
      "data": {
        UserName : user,
        _token: '{{csrf_token()}}' ,
      },
    },
    columns: [
    {data: 'Action', name: 'Action'},
    {data: 'Active', name: 'Active'},
    {data: 'ECC', name: 'ECC'},
    {data: 'CMR', name: 'CMR'},
    {data: 'CNC', name: 'CNC'},

    ],
    language: 
    {
      'loadingRecords': '&nbsp;',
      'processing': '<div class="spinner"></div>Processing...'
    }
  });
  $('#modal-user-action').modal();
  // $.ajax({
  //   url: "{{route('getUserAction')}}",
  //   type: 'POST',
  //   data: {
  //     UserName : user,
  //     _token: '{{csrf_token()}}',
  //   },
  //   success: function(response){

  //   }
  // }); 
}

function RegisteredUsers(office)
{
  $('#RegisteredUsers').DataTable({
    processing:true,
    info:true,
    ordering: false,
    // serverSide : true,
    scrollY: 400,
    deferRender: true,
    scroller:true,
    searching : true,
    destroy : true,
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
  });
}
</script>