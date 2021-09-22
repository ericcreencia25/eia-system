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
            <img id="" src="../img/doc1.jpg" style="width:38px;"><h1 class="box-title"><b>Applications for Action   -  </b></h1>
          </div>
          <div class="box-body">
          <div class="box-header">
                Listed below are the ECC Applications pending with you for appropriate action. Click the project name/address to load the application.
                <div class="box-tools">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-bordered">
                  <tbody><tr>
                    <th>Details</th>
                    <th>Status</th>
                    <th style="width: 280px">Remarks</th>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ url("ProjectApp") }}">PROPONENT NAME</a>
                      <br>SOMEWHERE MAASIM, SARANGGANI, R12<br/>
                    </td>
                    <td>
                      <i style="color:slategray;">For Submission of Basic Requirements</i>
                    </td>
                    <td>
                      <small>Please clarify this application. Thank you. - <i> jan evan callejo on Aug 7, 2019 10:16 am</i><small>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="">SAMPLE PREOJECT</a>
                      <br>ASD ABORLAN, PALAWAN, R4B<br/>
                    </td>
                    <td>
                      <i style="color:slategray;">Pending for Submission</i>
                    </td>
                    <td>
                      <small>IEE Project Checklist Downloaded/Prepared - lexmy on May 5, 2021 11:12 am</i><small>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="">LISAJAIME QUARRY</a>
                      <br>123 MANIBAUG PORAC, PAMPANGA, R03<br/>
                    </td>
                    <td>
                      <i style="color:slategray;"> For Clarification of Information</i>
                    </td>
                    <td>
                      <small>This is only a dummy account/ECC application used during the Workshop Training on Oct.09 at North Pointe Residence. - vicente dela cruz jr. on Oct 9, 2019 04:52 pm</i><small>
                    </td>
                  </tr>
                </tbody></table>
              </div>

        </div>
      </div>
    </section>
  </div>
@stop