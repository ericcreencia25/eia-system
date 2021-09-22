@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>New ECC Application</a></li>
            <li class="active"><i class="fa fa-user"></i>Purpose</li>
        </ol>
    </section>
@stop

@section('content')
<div class="content-wrapper">
  <section class="content container-fluid">
    <div class="box box-default">
      <div class="box-header with-border">
        <img id="" src="../img/doc1.jpg" style="width:38px;"><h1 class="box-title"><b>New ECC Application </b></h1>
        <button type="button" class="pull-right btn btn-block btn-danger btn-sm" style="width: 70px; height:30px">Reset</button>
        <br>
        <small style=" color:red; font-style:bold;">Note: You need to reach Step 6 to save entries and return to this application.</b></small>
      </div>
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><small><b>1. PURPOSE</b></small></a></li>
          <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><small><b>2. PROJECT TYPE</b></small></a></li>
          <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><small><b>3. DESCRIPTION OF PROPOSED PROJECT</b></small></a></li>
          <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"><small><b>4. PROJECT GEOGRAPHICAL INFORMATION</b></small></a></li>
          <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false"><small><b>5. BASIC PROJECT INFORMATION</b></small></a></li>
          <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false"><small><b>6. CHECKLIST & OTHER REQUIREMENTS</b></small></a></li>
          <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false"><small><b>7. ECC Application Requirements</b></small></a></li>
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
            @include('secured.new_applications.ecc_application_requirements')
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

