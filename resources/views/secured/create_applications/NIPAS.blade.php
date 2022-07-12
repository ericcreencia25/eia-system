

@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>New ECC Application</a></li>
            <li class="active"><i class="fa fa-user"></i>Purpose</li>
        </ol> -->
    </section>
@stop

@section('content')
<div class="content-wrapper no-padding">

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <!-- <div class="col-xs-12"> -->
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4>
            Determine if project located in the National Integrated Protected Area System (NIPAS)</h4>
          </div>
        <!-- </div> -->
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row">
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           Refer to the steps below to check if your proposed project is located within NIPAS. Click on the map area where your project is located or you may have to use the coordinate plotter tool and mouse scroll to zoom in. For projects with large area, please check the boundaries/extent coordinates of the project area.
           <br><br>
           IF YOUR PROJECT SOMEWHAT LOCATED IN NIPAS, PLEASE COORDINATE WITH BIODIVERSITY MANAGEMENT BUREAU TO CONFIRM.
          </p>

          <img class="img-responsive" src="../img/CheckIfInNIPAS.jpg" alt="Photo">

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
@stop

<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- DataTables -->
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(document).ajaxStart(function() { Pace.restart(); });
  $(document).ready(function(){
    $('#reset_data').on("click", function() {
      $.ajax({
        url: "{{route('ResetInputs')}}",
        type: 'GET',
        success: function(response){
          $('#myTab li a')[0].click();
          location.reload();
        }
      });
    });


    // $('#myTab a').click(function(e) {
    //   e.preventDefault();
    //   $(this).tab('show');
    // });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
      var id = $(e.target).attr("href").substr(1);
      window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');

    var activetab = $('#myTab').find('li.active');
  });
</script>
