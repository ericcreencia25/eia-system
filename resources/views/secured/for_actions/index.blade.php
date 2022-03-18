@extends('layouts.adminlte.default.layout')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css"/>
<style>
  .pointer {cursor: pointer;}

  /*.dataTables_filter {
    display: none;
  */}

</style>

@section('header')
<section class="content-header">
  <center>
    <h2><b>
      EIA Dashboard
      <small></small>
    </b></h2>
  </center>
        <!-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-cog"></i>For Action</a></li>
        </ol -->
    </section>
@stop




@section('content')

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container-fluid">

    <div id="accordion">
      <div class="box">
        <div class="box-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Company Details
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="box-body no-padding">
            <div class="col-md-12">
              <div class="col-md-4">
                <div id="map"></div>
              </div>
              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Company name</label>
                    <input type="text" class="form-control" id="company_name" placeholder="Company  Name" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">EMB ID</label>
                    <input type="text" class="form-control" id="emb_id" placeholder="EMB ID" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Establishment Name</label>
                    <input type="text" class="form-control" id="establishment_name" placeholder="Establishment Name" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Date Establishmented</label>
                    <input type="text" class="form-control" id="date_established" placeholder="Date Established" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Email" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Contact No.</label>
                    <input type="text" class="form-control" id="contact_no" placeholder="Contact No." disabled>
                  </div>
                  <label for="">Coordinates (Longitude, Latitude)</label>
                  <div class="form-group">
                    
                    <div class="col-xs-6 no-padding">
                      <input type="text" class="form-control" id="longitude" placeholder="Longitude" disabled>
                    </div>
                    <div class="col-xs-6 no-padding">
                      <input type="text" class="form-control" id="latitude" placeholder="Latitude" disabled>
                    </div>
                  </div>
                  
                </div>
              </div>

              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">House No.</label>
                    <input type="text" class="form-control" id="house_no" placeholder="House No." disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Street</label>
                    <input type="text" class="form-control" id="street" placeholder="Street" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Barangay Name</label>
                    <input type="text" class="form-control" id="barangay_name" placeholder="Barangay Name" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">City Name</label>
                    <input type="text" class="form-control" id="city_name" placeholder="City Name" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Province Name</label>
                    <input type="text" class="form-control" id="province_name" placeholder="Province Name" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Region Name</label>
                    <input type="text" class="form-control" id="region_name" placeholder="Region Name" disabled>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box box-default">
      <div class="box-header with-border">
        <img id="" src="../img/Tools.jpg" style="width:38px;"> <b>Applications for Action - </b>
      </div>
      <div class="box-body">
        <div class="box-header">
          Listed below are the ECC Applications pending with you for appropriate action. Click the project name/address to load the application.
        </di v>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <!-- <input type="text" id="searchInput" placeholder="Type Keywords..."> -->
          <table class="table table-bordered" id="ForActionTable">
            <thead style=" background-color: #f5f6f8">
              <th style="width: 40%; height: 30%">Details</th>
              <th style="width: 20%; height: 30%">Status</th>
              <th style="width: 40%; height: 30%">Remarks</th>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="box-header with-border">
        <!-- <h3 class="box-title"></h3> -->
        <a href="{{ url("/search/project-type") }}" class="btn btn-block btn-social btn-bitbucket btn-lg" style="text-align:center">
          APPLY FOR PERMIT
        </a>
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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script> -->

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyB6K1CFUQ1RwVJ-nyXxd6W0rfiIBe12Q&libraries=places" type="text/javascript"></script>

<script>
var UserOffice = "{{session('data')['UserOffice']}}";
var UserName = "{{session('data')['UserName']}}";
var UserRole = "{{session('data')['UserRole']}}";
$(document).ready(function(){

  //Login success pop-up
  var message = "{{session()->get('msg')}}";
  if(message != ''){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: message
    })

  }
  
  companyData();
  ResetSession();
  localStorage.clear();

  $('#ForActionTable').DataTable({
    processing:true,
    info:true,
    ordering: false,
    // serverSide : true,
    scrollY: 250,
    deferRender: true,
    scroller:true,
    searching : true,
    ajax: {
      "url": "{{route('get.users.list')}}",
      "type": "POST",
      "data": {
        UserName : UserName,
        UserRole : UserRole,
        UserOffice : UserOffice,
        _token: '{{csrf_token()}}' ,
      },
    },
    columns: [
    {data: 'Details', name: 'Details'},
    {data: 'Status', name: 'Status'},
    {data: 'Remarks', name: 'Remarks'},
    ],
    language: 
    {
      'loadingRecords': '&nbsp;',
      'processing': '<div class="spinner"></div>Processing...'
    }
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

function companyData()
{
  $.ajax({
    url: "{{route('companyData')}}",
    type: 'GET',
    success: function(response){
      mapView(parseFloat(response['latitude']), parseFloat(response['longitude']))
      $("#company_name").val(response['company_name']);
      $("#emb_id").val(response['emb_id']);
      $("#establishment_name").val(response['establishment_name']);
      $("#longitude").val(response['longitude']);
      $("#latitude").val(response['latitude']);
      $("#contact_no").val(response['contact_no']);
      $("#email").val(response['email']);

      $("#house_no").val(response['house_no']);
      $("#street").val(response['street']);
      $("#barangay_name").val(response['barangay_name']);
      $("#city_name").val(response['city_name']);
      $("#province_name").val(response['province_name']);
      $("#region_name").val(response['region_name']);
    }
  });
}

function mapView(lat,long) 
  {
    var coords = lat + "," + long;

    var url = 'https://maps.google.com/maps?q='+ coords +'&z=16&ie=UTF8&iwloc=&output=embed';
    var iframe = '<iframe id="googlemap"  src="'+url+'"width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

    $("#map").html(iframe);
  }
</script>