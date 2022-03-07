@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <!-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-cog"></i>For Action</a></li>
        </ol> -->
    </section>
@stop

<link rel="stylesheet" href="../../adminlte/dist/css/overlay-success.css">
<style>
  .pointer {cursor: pointer;}
</style>


@section('content')

    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="box box-default">
          <div class="box-header with-border">
            <img id="" src="../img/Tools.jpg" style="width:38px;"> <b>HOLIDAYS </b>
          </div>
          <div class="box-body">
          <div class="box-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-toggle="modal" data-target="#modal-default-national">Add National Holidays</button>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">Add Holiday</button>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <table class="table table-bordered" id="ForHolidaysTable" style="width: 100%;  display: table; table-layout: fixed;">
              <thead>
                <th>Description</th>
                <th>Date</th>
                <th>Notes</th>
                <th>Scope</th>
                <th>Action</th>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="title-holiday">Add Holiday</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div>
              <label>Description: </label>
              <input type="text" class="form-control" id="description" placeholder="Description" id="description">
            </div>
            <br>
            <div>
              <label>Date: </label>
              <input type="text" class="form-control" id="datepicker" placeholder="mm/dd/yyyy">
            </div>
            <br>
            <div>
              <label>Coverage:</label>
              <select class="form-control select2" multiple="multiple" data-placeholder="Select a Region" style="width: 100%;" id="coverage">
                @foreach($Regions as $Reg)
                <option value="{{ $Reg->Region}}" id="Reg_{{ $Reg->Region}}">{{ $Reg->Region}}</option>
                @endforeach
              </select>
            </div>
            <br>
            <div>
              <label>Notes: </label>
              <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:Small;height:100px;width:100%;padding:10px" id="notes"></textarea>
            </div>
            <br>
            <div>
              <label>Scope:</label>
              <select class="form-control" data-placeholder="Select a State" style="width: 100%;">
                <option>National</option>
                <option>Local</option>
              </select>
            </div>
            <br>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-default-national">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Add National Holiday/s</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div>
              <label>Description:</label>
              <select class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="national-description[]" id="national-description">
                @foreach($Holidays as $Holiday)
                <option value="{{ $Holiday->ID}}">{{ $Holiday->Description}} ( {{ date("F j", strtotime($Holiday->OnDate . date('Y')) ) }})</option>
                @endforeach
              </select>
            </div>
            <br>
            <div>
              <label>Notes: </label>
              <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:Small;height:100px;width:100%;padding:10px" id="national-notes"></textarea>
            </div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save-national-holiday">Save</button>
        </div>
      </div>
    </div>
  </div>
  <div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br/>
    <h3>Saving holidays...</h3>
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
  $('.select2').select2();

  ResetSession();
  localStorage.clear();

  //Date picker
  $('#datepicker').datepicker({
      autoclose: true
    });

  $('#ForHolidaysTable').DataTable({
    processing:true,
    info:true,
    searching: false,
    ordering: false,
    bPaginate: false,
    bLengthChange: false,
    bFilter: true,
    bInfo: false,
    bAutoWidth: false,
    ajax: {
      "url": "{{route('getHolidaysTable')}}",
      "type": "POST",
      "data": {
        UserName : UserName,
        UserRole : UserRole,
        UserOffice : UserOffice,
        _token: '{{csrf_token()}}' ,
      },
    },
    columns: [
    {data: 'Description', name: 'Description'},
    {data: 'Date', name: 'Date'},
    {data: 'Notes', name: 'Notes'},
    {data: 'Scope', name: 'Scope'},
    {data: 'Action', name: 'Action'},
    ],
    language: 
    {
      'loadingRecords': '&nbsp;',
      'processing': '<div class="spinner"></div>Processing...'
    }
  });

  $("#save-national-holiday").on('click', function() {
    var description = $("#national-description").val();
    var notes = $("#national-notes").val();

    Swal.fire({
      title: 'Are you sure?',
      text: "You want to add this holiday/s?",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{route('addHolidays')}}",
          type: 'POST',
          data: {
            DescriptionID: description,
            Notes : notes,
            _token: '{{csrf_token()}}' ,
          },
          beforeSend: function() {
            $('#overlay').show();
          },
          success: function(response){
            $('#overlay').fadeOut(2000, () => {
              Swal.fire({
                icon: 'success',
                title: 'Holiday/s has been added.',
                showConfirmButton: false,
                timer: 1500,
                width: '850px'
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  location.reload();
                }
              });
            });
          }
        });
      }
    })
  });

  $(document).on('hidden.bs.modal','#modal-default', function () {
    $("#title-holiday").html('Add Holiday');
    $("#description").val('');
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

function editHoliday(ID)
{
  $("#title-holiday").html('Edit Holiday');

  $.ajax({
    url: "{{route('getSpecificHolidays')}}",
        type: 'POST',
        data: {
          ID : ID,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          console.log(response);
          $("#description").val(response['Description']);
          // $("#datepicker").val(response['OnDate']);
          var $datepicker = $('#datepicker');
          $datepicker.datepicker();
          $datepicker.datepicker('setDate', response['OnDate']);
          $("#coverage").val(response['Coverage']);

          $("#notes").val(response['Notes']);
          // var count = 1;
          // $.each(response['Coverage'], function(index, value ) {
          //   val = "'" + value + "'"
          //   var cov = '<li class="select2-selection__choice" title="' + value  + '" id="from_'+count+'"><span role="presentation" onclick="removeLI('+count+ "," + val + ')"> × </span>' + value  + '</li>';

          //   $(".select2-search").append(cov);
          //   count++;
          // });
        }
      }); 

  $("#modal-default").modal();
}

function removeLI(ID, Region)
{
  $('#from_' + ID).remove();
  unSelectLI(Region);
}

function unSelectLI(Region)
{
  var unSelect = '<li class="select2-results__option" id="select2-coverage-result-ao5q-'+Region+'" role="treeitem" aria-selected="false">'+Region+'</li>';
}
</script>