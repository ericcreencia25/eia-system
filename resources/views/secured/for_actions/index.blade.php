@extends('layouts.adminlte.default.layout')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css"/>
<style>
  .pointer {cursor: pointer;}

  .dataTables_filter {
    display: none;
  }

  /*.dataTables_filter {
    display: none;
  */}

  .custom {
        width: 1600px;
        min-height: 400px;
      }

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
              Company/Proponent Details  
            </button>

            <span id="company-status"></span>

            <img class="pointer" id="comparison-button" src="../img/compare.png" style="width:38px;">
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
                    <label for="exampleInputPassword1">Date Established</label>
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
                  <div class="form-group">
                    <label for="exampleInputPassword1">CEO/President/Owner</label>
                    <input type="text" class="form-control" id="contact_person" placeholder="CEO/President/Owner" disabled>
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

<div class="modal fade" id="comparison-modal">
  <div class="modal-dialog modal-xl" style="width: 1150px">
    <div class="modal-content custom">
      <div class="modal-header" style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="col-md-4" style="padding-left: 20px;">
                <div class="form-group col-md-12 no-padding"><h3>Search</h3></div>
                <!-- <div class="input-group input-group-sm" style="padding-bottom: 10px"> -->
                  <!-- <input type="text" class="form-control" placeholder="Search Company..."> -->

                  <!-- <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat">search</button>
                  </span> -->

                  <!-- <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-info btn-flat" id="clear-input"><span class="glyphicon glyphicon-search form-control-feedback"></span></button>
                        </span>
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-info btn-flat" id="clear-input"><i class="fa fa-refresh"></i></button>
                        </span>

                  </div> -->

                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control" id="searchInput" placeholder="search keyword for company name">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-info btn-flat" id="searchButton" title="search keyword for company name"><i class="fa fa-search"></i></button>
                          <button type="button" class="btn btn-info btn-flat" id="clear-input" title="clear"><i class="fa fa-refresh"></i></button>
                        </span>
                  </div>

                  <!-- <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Search Mail" id="searchInput">
                  </div>

                  <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" id="clear-input"><span class="glyphicon glyphicon-search form-control-feedback"></span></button>
                  </span>

                  <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" id="clear-input"><i class="fa fa-refresh"></i></button>
                  </span> -->
                <!-- </div> -->

                <table class="table" id="searchCompany">
                </table>

              </div>

              <div class="col-md-8" style="padding-left: 20px;border-left: 1px solid #d2d6de;">
                <div class="form-group col-md-12 no-padding"><h3>From ECC <span id="company-status-modal"></span></h3></div>

                <div class="form-group col-md-12 no-padding">
                  <label for="exampleInputEmail1">ID: (Auto-generated)</label>
                  <input type="text" class="form-control" id="proponent_guid_proponent" placeholder="ID: (Auto-generated)" disabled>
                </div>
                
                <div class="form-group col-md-12 no-padding">
                  <label for="exampleInputEmail1">Company name</label>
                  <input type="text" class="form-control" id="company_name_proponent" placeholder="Company  Name" disabled>
                </div>

                <div class="form-group col-md-6 no-padding">
                  <label for="">Email</label>
                  <input type="text" class="form-control" id="email_proponent" placeholder="Email" disabled>
                </div>

                <div class="form-group col-md-6 no-padding">
                  <label for="">Contact No.</label>
                  <input type="text" class="form-control" id="contact_no_proponent" placeholder="Contact No." disabled>
                </div>

                <div class="form-group col-md-12 no-padding">
                  <label for="">Address</label>
                  <input type="text" class="form-control" id="address_proponent" placeholder="Address" disabled>
                </div>

                <div class="form-group col-md-12 no-padding">
                  <label for="">CEO/President/Owner</label>
                  <input type="text" class="form-control" id="contact_person_proponent" placeholder="CEO/President/Owner" disabled>
                </div>
              </div>
              <center>
                <button class="btn btn-success" id="bind">BIND</button>
                <button class="btn btn-danger" id="unbind">UNBIND</button>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    ]
  });

  $('#comparison-button').on('click', function() {
    // $.ajax({
    //   url: "{{route('companyData')}}",
    //   type: 'GET',
    //   success: function(response){
    //     $("#company_name_comparison").val(response['company_name']);
    //     $("#emb_id_comparison").val(response['emb_id']);
    //     $("#establishment_name_comparison").val(response['establishment_name']);
    //     $("#contact_no_comparison").val(response['contact_no']);
    //     $("#email_comparison").val(response['email']);

    //     var Address = response['house_no'] + ' ' + response['street'] + ' ' + response['barangay_name'] + ' ' + response['city_name'] + ' ' + response['province_name'];

    //     $('#address_comparison').val(Address.toUpperCase());

        
    //   }
    // });

    $('#comparison-modal').modal();

      searchCompany();

  });

  $("#bind").on('click', function() {
    var EmbID = $("#emb_id").val();
    var ProponentGUID = $("#proponent_guid_proponent").val();
    var CompanyName = $("#company_name").val();
    var ProponentName = $("#company_name_proponent").val();

    Swal.fire({
      title: 'Do you want to bind this company?',
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          url: "{{route('addBindData')}}",
          type: 'POST',
          data: {
            EmbID : EmbID,
            ProponentGUID : ProponentGUID,
            CompanyName : CompanyName,
            ProponentName : ProponentName,
            _token: '{{csrf_token()}}' ,
          },  
          success: function(response){
            Swal.fire(response, '', 'info')
            location.reload();
          }
        });
      }
    })
  })

  $("#unbind").on('click', function() {
    var EmbID = $("#emb_id").val();
    var ProponentGUID = $("#proponent_guid_proponent").val();
    var CompanyName = $("#company_name").val();

    Swal.fire({
      title: 'Do you want to unbind this?',
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          url: "{{route('unBindData')}}",
          type: 'POST',
          data: {
            EmbID : EmbID,
            ProponentGUID : ProponentGUID,
            CompanyName : CompanyName,
            _token: '{{csrf_token()}}' ,
          },  
          success: function(response){
            Swal.fire(response, '', 'info')
            location.reload();
          }
        });
      }
    })
  })

  $("#clear-input").on('click', function() {
    $("#proponent_guid_proponent").val('');
    $("#company_name_proponent").val('');
    $("#email_proponent").val('');
    $("#contact_no_proponent").val('');
    $("#address_proponent").val('');
    $('#contact_person_proponent').val('');
  })

  Swal.bindClickHandler()

    Swal.mixin({
      toast: true,
    }).bindClickHandler('data-swal-toast-template')


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
      $("#company_name").val(response['company_name']);
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
      $('#contact_person').val(response['ceo_fname'] + ' ' + response['ceo_sname'])

      
      getBindedData(response['emb_id'], response['company_name']);
    }
  });

  // getBindedData('EMBR2-1314200-45572', '24/7 INN & RESORT');
}


function searchCompany()
{
  $("#searchButton").on('click', function(){
    var search = $("#searchInput").val();

    if(search.length < 3){
      alert('Need 3 or more letters for the keywords');
    } else {
      var table = $('#searchCompany').DataTable({
        processing:true,
        ordering: false,
        scrollY: 250,
        deferRender: true,
        scroller:true,
        searching : true,
        destroy: true,
        ordering: false,
        bPaginate: false,
        bLengthChange: false,
        bFilter: true,
        bInfo: false,
        bAutoWidth: false,
        ajax: {
          "url": "{{route('searchCompany')}}",
          "type": "POST",
          "data": {
            search : search,
            _token: '{{csrf_token()}}' ,
          },
        },
        columns: [
        {data: 'ProponentName', name: 'ProponentName'},
        {data: 'Action', name: 'Action'},
        ]
      });

    }

      
  });
  
  // $('#searchInput').on('keyup change', function () {
  //   table.search(this.value).draw();
  // });
}



function mapView(lat,long) 
{
  var coords = lat + "," + long;

  var url = 'https://maps.google.com/maps?q='+ coords +'&z=16&ie=UTF8&iwloc=&output=embed';
  var iframe = '<iframe id="googlemap"  src="'+url+'"width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

  $("#map").html(iframe);
}


function ComparisonData(Name)
{
  $.ajax({
    url: "{{route('getProponentInformationComparison')}}",
    type: 'POST',
    data: {
      Name : Name,
      _token: '{{csrf_token()}}',
    },
    success: function(response){
      $('#proponent_guid_proponent').val(response['GUID']);
      $('#company_name_proponent').val(response['ProponentName']);
      $('#email_proponent').val(response['ContactPersonEmailAddress']);
      $('#contact_no_proponent').val(response['MobileNo']);
      $('#address_proponent').val(response['MailingAddress'].toUpperCase())
      $('#contact_person_proponent').val(response['ContactPerson']);
    }
  }); 
}

function getBindedData(emb_id, company_name)
{
  $.ajax({
      url: "{{route('getBindedData')}}",
      type: 'POST',
      data: {
        emb_id : emb_id,
        company_name : company_name,
        _token: '{{csrf_token()}}' ,
      },
      success: function(response){
        
        if(response == '' || response['ProponentGUID'] == ''){

          $('#company-status').removeAttr('class');
          $('#company-status').attr('class', 'badge bg-red');
          $('#company-status').text('UNBIND');

          $('#company-status-modal').removeAttr('class');
          $('#company-status-modal').attr('class', 'badge bg-red');
          $('#company-status-modal').text('UNBIND');

        } else {

          $('#company-status').removeAttr('class');
          $('#company-status').attr('class', 'badge bg-green');
          $('#company-status').text('BINDED');

          $('#company-status-modal').removeAttr('class');
          $('#company-status-modal').attr('class', 'badge bg-green');
          $('#company-status-modal').text('BINDED');

        }

        ComparisonData(response['ProponentName']);
      }
    });
}
</script>