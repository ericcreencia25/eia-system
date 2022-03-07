

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
<div class="content-wrapper">
  <section class="content container-fluid">
    <div class="box box-primary">
      <div class="box-header with-border">
        <img id="" src="../img/doc1.jpg" style="width:38px;">
        <!-- <h1 class="box-title"><b>New ECC Application </b></h1> -->
        <b>New ECC Application </b>
        <button type="button" class="pull-right btn btn-block btn-danger btn-sm" style="width: 70px; height:30px" id="reset_data">Reset</button>
        <br>
        <small style=" color:red; font-style:bold;">Note: You need to reach Step 6 to save entries and return to this application. Make sure to save every page before saving your entry in Step 6. </b></small>
      </div>
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs"  id="myTab">
          <li name="li" class="active" style="width: 90px; overflow:hidden; white-space:nowrap;text-overflow: ellipsis;"><a href="#tab_1" data-toggle="tab" aria-expanded="true" id="step_1" ><small><b>1. PURPOSE</b></small></a></li>

          <li name="li" id="li_step_2" class="disabled" style="width: 100px; overflow:hidden; white-space:nowrap;text-overflow: ellipsis;"><a href="#tab_2" aria-expanded="false" id="step_2"><small><b>2. PROJECT T...</b></small></a></li>

          <li id="li_step_3"  class="disabled" style="width: 130px; overflow:hidden; white-space:nowrap;text-overflow: ellipsis;"><a href="#tab_3"  aria-expanded="false"id="step_3"><small><b>3. DESCRIPTION ... </b></small></a></li>

          <li id="li_step_4"  class="disabled" style="width: 130px; overflow:hidden; white-space:nowrap;text-overflow: ellipsis;"><a href="#tab_4" aria-expanded="false" id="step_4"><small><b>4. PROJECT GEO...</b></small></a></li>

          <li id="li_step_5"  class="disabled" style="width: 130px; overflow:hidden; white-space:nowrap;text-overflow: ellipsis;"><a href="#tab_5"  aria-expanded="false" id="step_5"><small><b>5. BASIC PROJECT ...</b></small></a></li>

          <li id="li_step_6"  class="disabled" style="width: 130px; overflow:hidden; white-space:nowrap;text-overflow: ellipsis;"><a href="#tab_6"  aria-expanded="false" id="step_6"><small><b>6. CHECKLIST & ...</b></small></a></li>

          <li id="li_step_7"  class="disabled" style="width: 130px; overflow:hidden; white-space:nowrap;text-overflow: ellipsis;"><a href="#tab_7" aria-expanded="false" id="step_7"><small><b>7. ECC Application ...</b></small></a></li>

          <li id="li_step_8"  class="disabled" style="width: 140px; overflow:hidden; white-space:nowrap;text-overflow: ellipsis;"><a href="#tab_8" aria-expanded="false" id="step_8"><small><b>8. Confirm Submission</b></small></a></li>

        </ul>
        <div class="tab-content">
          <!--purpose-->
          <div class="tab-pane active" id="tab_1">
            @include('secured.create_applications.index')
          </div>
          <!--project type-->
          <div class="tab-pane" id="tab_2">
            @include('secured.create_applications.project_type')
          </div>
          <!--description of project-->
          <div class="tab-pane" id="tab_3">
            @include('secured.create_applications.description')
          </div>
          <div class="tab-pane" id="tab_4">
            @include('secured.create_applications.geographical_information')
          </div>
          <div class="tab-pane" id="tab_5">
            @include('secured.create_applications.basic_project_info')
          </div>
          <div class="tab-pane" id="tab_6">
            @include('secured.create_applications.checklist')
          </div>
          <div class="tab-pane" id="tab_7">
            @include('secured.create_applications.ecc_application_requirements')
          </div>
          <div class="tab-pane" id="tab_8">
            @include('secured.create_applications.confirm_submission')
          </div>
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

<script>
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
