@extends('layouts.adminlte.default.layout')

<style>
  .pointer {cursor: pointer;}

  .dataTables_filter {
    display: none;
  }

/*  td.table-cell-edit{
      background-color: Silver;
  }*/

  span.limit {
    /*display: block;*/
    word-wrap:break-word;
    width: 250px;
    height: 70px;
    white-space: normal
}

</style>

@section('header')
<section class="content-header">
</section>
@stop




@section('content')

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container-fluid">

    <div class="box box-default">
      <!-- <div class="box-header with-border">
        <img id="" src="../img/Tools.jpg" style="width:38px;"> <b>Applications for Action - </b>
      </div> -->
      <div class="box-body">
        <div class="box-header">
          <div class="col-md-12">
            <!-- <div class="col-md-4"> -->
              <ul class="chart-legend clearfix pull-right"><label>Legend:</label> 
                <li><i class="fa fa-square text-yellow"></i> CNC Application</li>
                <li><i class="fa fa-square text-light-blue"></i> IEE Checklist</li>
                <li><i class="fa fa-square text-green"></i> EIS</li>
              </ul>
            <!-- </div> -->
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <!-- <input type="text" id="searchInput" placeholder="Type Keywords..."> -->
          <input class="form-control form-control-lg col-xs-4" type="text" placeholder="Type Keywords..." id="searchInput">

          <table class="table" id="projectType" style="width: 100%;  display: table;">
            <thead style=" background-color: #f5f6f8">
              <th width="30%">CATEGORY</th>
              <th width="30%">SPECIFIC TYPE</th>
              <th width="20%"><small>PROPOSED PROJECT SIZE <br> <span style="color:red;">(DO NOT SPLIT SIZE)</span> </small></th>
              <th width="10%"></th>
              <th width="10%"></th>
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
  ResetSession();
  localStorage.clear();

  $('#projectType').DataTable({
      processing:true,
      info:true,
      ordering: false,
      // serverSide : true,
      scrollY: 350,
      deferRender: true,
      scroller:true,
      searching : true,

      // bPaginate: false,
      // bLengthChange: false,
      // bInfo: false,
      bAutoWidth: false,

      ajax: {
        "url": "{{route('getProjectType')}}",
        "type": "POST",
        "data": {
          ComponentGUID : '',
          search : '',
          ProjectSize : '',
          _token: '{{csrf_token()}}' ,
        },
      },
      columns: [
      {data: 'Category', name: 'Category'},
      {data: 'SpecificType', name: 'SpecificType'},
      {data: 'ProjectSize', name: 'ProjectSize', className: "table-cell-edit"},
      {data: 'ProjectSizeInput', name: 'ProjectSizeInput'},
      {data: 'Action', name: 'Action'}
      ]
    });

  var table = $('#projectType').DataTable();

  // #myInput is a <input type="text"> element
  $('#searchInput').on('keyup change', function () {
      table.search(this.value).draw();
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
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          document.location = href + result;
        }
      }); 
  }

  function ProjectSize(ComponentGUID, Category, ReportType) {
    var id = "#input_project_size_" + ComponentGUID;
    var input_size = $(id).val();

    var min = $(id).attr("min");

    var max= $(id).attr("max");

    

    if(ReportType == 'IEE'){
      var Type = 'Initial Environmental Examination Checklist'
    } else {
      var Type = '';
    }

    var html = 'Are you sure you want to apply to ' + Type + ' (' +ReportType+') ?';

    if(input_size != ''){
      if(inRange(input_size, min, max))
      {
        Swal.fire({
          // title: 'Are you sure?',
          // text: "You won't be able to revert this!",
          icon: 'info',
          html:html,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, apply!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "{{route('LinkProjectType')}}",
              type: 'POST',
              data: {
                Category : Category,
                ReportType : ReportType,
                ComponentGUID : ComponentGUID,
                input_size : input_size,
                _token: '{{csrf_token()}}',
              },
              success: function(result)
              {
                var url = "/NewDocument/" + result;

                // window.open(url,'_blank');

                document.location = url;
              }
            });
          }
        });
      } else {
        Swal.fire('Your value is out of range');
      }
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Notifications!',
        text: 'Proposed Project Size accepts numeric value only.',
        // footer: '<a href="">Why do I have this issue?</a>',
        width: '850px'
      });
    }
  }

  function inRange(x, min, max) {
    return ((x-min)*(x-max) <= 0);
  }
</script>