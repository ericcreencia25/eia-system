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

  .align-left {
    text-align: left;
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
              <!-- <ul class="chart-legend clearfix pull-right"><label>Legend:</label> 
                <li><i class="fa fa-square text-yellow"></i> CNC Application</li>
                <li><i class="fa fa-square text-light-blue"></i> IEE Checklist</li>
                <li><i class="fa fa-square text-green"></i> EIS</li>
              </ul> -->
              <!-- </div> -->
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
          <!-- <div class="box-header with-border">
            <h5 class="box-title">Project Grouping Matrix for Determination of EIA Report Types for New Single & Co-Located Projects</h5>
          </div> -->
          <div class="input-group col-xs-4 pull-right" style="padding-bottom: 10px">
            <div class="input-group-btn">
              <button type="button" class="btn btn-primary" disabled>Search</button>
            </div>

            <input class="form-control" type="text" placeholder="Type Keywords of EIA Report Types..." id="searchInput">
          </div>
          

          <table class="table" id="projectType" style="width: 100%;  display: table;">
            <thead style=" background-color: #f5f6f8">
              <th width="5%">Ref.ID</th>
              <th width="30%">CATEGORY</th>
              <th width="25%">SPECIFIC TYPE</th>
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

<div id="modal-apply-permit"></div>
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
        _token: '{{csrf_token()}}',
      },
    },
    columns: [
    {data: 'ReferenceID', name: 'ReferenceID'},
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
        _token: '{{csrf_token()}}',
      },
      success: function(response){
        document.location = href + result;
      }
    });
  }

  function ProjectSize(ComponentthresholdGUID, ComponentGUID, ReportType){
    var id = "#input_project_size_" + ComponentGUID;
    var input_size = $(id).val();

    $.ajax({
      url: "{{route('getComponents')}}",
      type: 'POST',
      data: {
        ReportType : ReportType,
        ComponentGUID : ComponentGUID,
        input_size : input_size,
        _token: '{{csrf_token()}}',
      },
      success: function(result)
      {
      // #f39c12 - yellow
      // #3c8dbc - blue
      // #00a65a - green

      if(result['ReportType'] === 'EIS'){
        var buttonColor = '#00a65a';
      }else if(result['ReportType'] === 'IEE'){
        var buttonColor = '#3c8dbc';
      }else if(result['ReportType'] === 'CNC Application'){
        var buttonColor = '#f39c12';
      }

      if(result != ''){
        if(result['ProjectSpecificSubType'] == 'NULL'){
          var subtype = '';
        } else {
          var subtype = result['ProjectSpecificSubType'];
        }

        if(result['ProjectSpecificType'] == 'NULL'){
          var specifictype = '';
        } else {
          var specifictype = result['ProjectSpecificType'];
        }

        var table = '<table class="table" style="width: 100%;  display: table;">';
        table += '<tr>';
        table += '<th style=" background-color: #f5f6f8" width="30%">CATEGORY</th>';
        table += '<td><b><small>'+result['ProjectType'].toUpperCase() + '</b> ('+result['Category']+') </b> <br>' + result['ProjectSubType']+'</td>';
        table += '</tr>';

        table += '<tr>';
        table += '<th style=" background-color: #f5f6f8"  width="30%">SPECIFIC TYPE</td>';
        table += '<td><small>'+specifictype.toUpperCase() +'</b>' + subtype +'</td>';
        table += '<tr>';

        table += '<tr>';
        table += '<th style=" background-color: #f5f6f8" width="20%"><small>PROJECT SIZE <br></td>';
        table += '<td><b><small>'+result['Parameter'].toUpperCase() + '</b>' + '<br> Min: ' + result['Minimum']  + ' ' + result['UnitOfMeasure']  + '<br> Max: ' + result['Maximum'] + ' '  + result['UnitOfMeasure'] +'</td>';
        table += '<tr>';

        table += '<tr>';
        table += '<th style=" background-color: #f5f6f8" width="20%"><small>PROPOSED PROJECT SIZE <br></td>';
        table += '<td>'+ input_size + ' ' + result['UnitOfMeasure'].toUpperCase() +'</td>';
        table += '<tr>';


        table += '<tbody></tbody>';
        table += '</table>';

        var html = '<div class="align-left"><b>' +result['ProjectType'].toUpperCase() +'</b> <br>' + result['ProjectSubType'] + '</div><br>' + table ;

        var button = result['ReportType'];

        Swal.fire({
          html:html,
          width: 800,
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Apply ' + button + ' Permit',
          confirmButtonColor: buttonColor,
        }).then((response)  => {
          if (response.isConfirmed) {
            if(result['ReportType'] === 'EIS'){
              Swal.fire('Link for EIS Application');
            }else if(result['ReportType'] === 'IEE'){
              applyPermit(result, input_size);
            }else if(result['ReportType'] === 'CNC Application'){
              Swal.fire('Link for CNC Application');
            }
          }
        });
      } else {
        Swal.fire('Your value is out of range');
      }
    }
  });
  }

  function applyPermit(result, input_size){
    ReportType = result['ReportType'];
    min =  result['Minimum'];
    max = result['Maximum'];
    ComponentGUID = result['GUID'];
    if(ReportType == 'IEE'){
      var Type = 'Initial Environmental Examination Checklist'
    } else {
      var Type = ReportType;
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