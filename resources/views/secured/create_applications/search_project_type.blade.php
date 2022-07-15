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
          <img id="" src="../img/doc1.jpg" style="width:38px;"><h1 class="box-title"><b></b></h1>
        </div>
      </div>
      <div class="box-body">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
         <center><u><h4>Project Grouping Matrix for Determination of EIA Report Types for New Single & Co-Located Projects</h4></u>
          <div class="input-group col-xs-8" style="padding-bottom: 15px;">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search Keyword">
            <div class="input-group-btn">
              <button type="button" id="search_button"name="submit" class="btn btn-primary btn-flat" style="width: 50px; height: 35px"><i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </center>
        <table class="table table-bordered" id="ProjectTypeTable" style="width: 100%;  display: table; table-layout: fixed; text-align: center;">
          <thead>
            <th style="width: 10%; text-align: center;">Ref. ID</th>
            <th style="text-align: center;">Project Type</th>
            <th style="text-align: center;">Project SubType</th>
            <th style="text-align: center;">Specific Type</th>
            <th style="text-align: center;">Project Size Parameter</th>
            <th style="text-align: center;">Category</th>
            <th style="text-align: center;">Report Type</th>
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

    $("#search_button").on('click', function(){
      var search = $('#search').val();

      $('#ProjectTypeTable').DataTable({
        destroy:true,
        processing:true,
        info:true,
        searching: false,
        ordering: false,
        scrollX: true,
        ajax: {
          "url": "{{route('ProjectTypeTable')}}",
          "type": "POST",
          "data": {
            search : search,
            _token: '{{csrf_token()}}' ,
          },
        },
        columns: [
        
        {data: 'ReferenceID', name: 'ReferenceID'},
        {data: 'ProjectType', name: 'ProjectType'},
        {data: 'ProjectSubType', name: 'ProjectSubType'},
        {data: 'SpecificType', name: 'SpecificType'},
        {data: 'ParameterOrig', name: 'ParameterOrig'},
        {data: 'Category', name: 'Category'},
        {data: 'Action', name: 'Action'},
        ]
      });
    });
  });

  function LinkProject(ComponentGUID, Category, ReportType)
  {
    $.ajax({
      url: "{{route('LinkProjectType')}}",
      type: 'POST',
      data: {
        Category : Category,
        ReportType : ReportType,
        ComponentGUID : ComponentGUID,
        _token: '{{csrf_token()}}',
      },
      success: function(result)
      {
        var url = "/NewDocument/" + result;

        window.open(url,'_blank');
      }
    });
  }

  function ResetSession(){
    $.ajax({
      url: "{{route('ResetInputs')}}",
      type: 'GET',
      success: function(response){
      }
    });
  }

</script>