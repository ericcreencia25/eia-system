<style>
  .pointer {cursor: pointer;}

  .align-left {
    text-align: left;
  }

</style>

<div class="box-body">
  <div class="callout callout-default" style="background: #ccc; margin-bottom: 0px">
    <div>
      <button type="button" class="btn btn btn-primary pull-right" id="check_step_4">Confirm <i class="fa fa-fw fa-save"></i></button>
    </div>
    <h4><b>4. PROJECT GEOGRAPHICAL INFORMATION: 

      <span id="proceed_4"></span>
    </b><br></h4>
    <i>Select from the shape icon below to add the project area (triangle - for polygon area, Line icon - for bridge, roads etc). Click only once if you only have (1) project area. The project area number will appear in the list. If you have MORE THAN (1) project area, make sure you have selected the appropriate project area number from the list before adding the geo-coordinate (latitude and longitude). Please add the coordinates in sequence. You may have to pad/add '0' if the coordinate has fewer digits. For consistency purposes, please use the World Geodetic System 1984 (WGS84) Datum Convention. Mobile Phones and most online maps are using this convention by default.</i><br><br>
  </div>
  <div style="border:Solid 1px Silver;">
    <div style="  background-color:#C3D1E6; ">
      <table cellspacing="0" cellpadding="3" style="background-color:#C3D1E6;  ">
        <tbody>
          <tr style="font-size:7pt">
            <td colspan="2">Clik icon to Add Area</td>
            <td style="padding-left:30px;">Selected Area</td>
            <td>Geo-format</td>
            <td></td>
            <td>Latitude (pad space with 0)</td>
            <td>Longitude (pad space with 0)</td>
          </tr>
          <tr>
            <td> <input type="image" name="" id="" title="Click to add a polygon" src="../img/polygon.PNG" onclick="addSelectedArea('Polygon')" style="background-color:White;width:30px;"> 
            </td>
            <td> 
              <input type="image" name="" id="" title="Click to add a line" src="../img/line.PNG" onclick="addSelectedArea('Line')" style="background-color:White;width:30px;">
            </td>
            <td style="padding-left:30px;">
              <select  id="selected_area" style="width:70px;"class="form-control">
                <!-- <option selected="selected" value=""></option> -->
              </select>
            </td>
            <td>
              <select id="geo_format" style="width:150px;"class="form-control">
                <option selected="selected" value="0">Decimal</option>
                <option value="1">Deg-Min-Sec</option>
              </select>
            </td>
            <td style="padding-left:30px;">Geo-Coordinate</td>
            <td>
              <input type="text" placeholder="__°___'___.____&quot;" id="deg_lat" name="deg_lat" onkeypress="lat(this.value)" maxlength="16">

              <input type="text" name="deci_lat" id="deci_lat" class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

            </td>
            <td>
              <input type="text" placeholder="___°___'___.____&quot;" id="deg_long" name="deg_long" onkeypress="long(this.value)" maxlength="16">

              <input type="text" name="deci_long" id="deci_long" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </td>
            <td>
              <input type="submit" name="" class="btn btn-block btn-flat btn-success" value="Add Point " id="add_point" title="Click to add point">
            </td>
            <td style="padding-left:50px;">
              <input type="submit" name="" value="Remove Area " onclick="RemoveArea()" id="" title="Click to remove the selected area" class="btn btn-block btn-flat btn-warning">
            </td>
            <td>&nbsp;&nbsp;
              <input type="image" name="" id="" title="Click here to view your current location in map" class="imgbutton" src="../img/globe.jpg" style="background-color:White;width:35px;" onclick="ShapesPreview()">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="box">
      <div class="box-body no-padding">
        <!-- <div class="col-md-12" style="padding-top: 10px"> -->
          <div class="col-md-12">
            <div id="map" style="width: 100%; height: 500px;" hidden></div>
          </div>

          <!-- <div class="col-md-4">
            <table class="table table-bordered" style="width: 100%">
              <thead>
                <th>Area</th>
                <th>View</th>
              </thead>
              <tbody id="geocoordinate_body_area">
              </tbody>
            </table>
          </div> -->
          <!-- </div> -->
        </div>
      </div>
      <div class="box">
        <div  class="box-body">
          <div class="col-md-12" style="padding-top: 10px">
            <table class="table table-bordered" id="ProjectGeoCoordinatesTable" style="width: 100%">
              <thead>
                <th>Area</th>
                <th>Type</th>
                <th>DMS Latitude</th>
                <th>DMS Longitude</th>            
                <th>Decimal Latitude</th>
                <th>Decimal Longitude</th>
                <th></th>
                <th></th>
                <th hidden></th>
              </thead>
              <tbody id="geocoordinate_body">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @extends('secured.create_applications.map')
  </div>
  <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
  <!-- <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script> -->

  <script>
    var url=window.location.pathname;
    var arr=url.split('/');
    var NewGUID=arr[2];
    let polygonCount = 0;
    let lineCount = 0;
    var coordinatesChecklist = [];
    var hash = window.location.hash;

    $(document).ready(function() {

    // $("#li_step_4").on('click', function() {
      

    // });
    
    $('[data-mask]').inputmask();

    $("#deg_lat").hide();
    $("#deg_long").hide();

    ///Geocoordinates type
    $('#geo_format').on('change', function() {
      var geo_format = $('#geo_format').val();
      if(geo_format == 0){
        $("#deci_lat").show();
        $("#deci_long").show();

        $("#deg_lat").hide();
        $("#deg_long").hide();
      } else {
        $("#deci_lat").hide();
        $("#deci_long").hide();

        $("#deg_lat").show();
        $("#deg_long").show();
      }
    });

    //add data in table
    $("#add_point").click(function() {
      var count = 0;
      var geo_format = $('#geo_format').val();

      var selected_area_txt = $("#selected_area option:selected").text();
      var selected_area_val = $("#selected_area").val();

      var geo_format = $('#geo_format').val();

      var arr=selected_area_val.split('__');

      var selected_area=arr[0];
      var AreaGUID=arr[1];

      if(geo_format == 0){
        var decimal_latitude = $("#deci_lat").val();
        var decimal_longitude = $("#deci_long").val();

        var dms_latitude = DDtoDMS(decimal_latitude);
        var dms_longitude = DDtoDMS(decimal_longitude);
      } else {
        var dms_latitude = $("#deg_lat").val();
        var dms_longitude = $("#deg_long").val();

        var decimal_latitude = DMStoDD(dms_latitude);
        var decimal_longitude = DMStoDD(dms_longitude);
      }

      if(selected_area_val != null){
        var html_code = "<tr class='row_"+ selected_area_txt +"'>";
        html_code += "<td>"+selected_area_txt+"</td>";
        html_code += "<td>"+selected_area+"</td>";
        html_code += "<td>"+dms_latitude+ "</td>";
        html_code += "<td>"+dms_longitude+ "</td>";
        html_code += "<td>"+decimal_latitude+"</td>";
        html_code += "<td>"+decimal_longitude+"</td>";
        html_code += '<td><button type="button" class="btn btn-default" id="remove" title="delete coordinates"><img src="../img/trashbin.jpg" style="width:15px;" /></button></td>';
        html_code += '<td><button type="button" class="btn btn-default" id="map-view"       onclick="clickMe('+decimal_latitude+', '+"'"+decimal_longitude+"'"+')" title="view by point"><img src="../img/map.png" style="width:17px;" /></button></td>';
        html_code += "<td hidden>"+AreaGUID+"</td>";
        html_code += "</tr>";
        $("#geocoordinate_body").append(html_code);
      } else {
        alert('Add area');
      }

      ////empty input field
      $("#deci_lat").val('')
      $("#deci_long").val('');
      $("#deg_lat").val('');
      $("#deg_long").val('');
    });


    ///check if there's already an input in session
    var step4_check = "{{ Session::has('step_4_status') ? Session::get('step_4_status') : 'N/A' }}";

    
    if(step4_check == 1){
      $("#li_step_5").attr("class", "able");
      $("#step_5").attr("data-toggle", "tab");

      $("#step_4").css({"background-color":"#3c8dbc", "color": "#ffffff"});

      Maps();

    } else if(step4_check == 0){
      $("#step_4").css({"background-color":"#dd4b39", "color": "#ffffff"});
    } else if(step4_check == "N/A"){
      if (navigator.geolocation)
      {
        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
      }
      else 
      {
        alert('It seems like Geolocation, which is required for this page, is not enabled in your browser.');
      }
      // $("#step_4").css({"background-color":"#fff", "color": "#444"});
    }

    $('.table tbody').on('click', '#remove', function() { 
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this coordinates?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
          $(this).closest('tr').remove();
        }
      })
    });

    var successMessage = [];
    var errorMessage = [];
    var text = '';

  /// onclick of proceed: save to session
  $('#check_step_4').on("click", function() {
    Swal.fire({
      title: 'Do you want to save the changes?',
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        proceedNextStep();
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    });
  });


  // You need to provide the geo-coordinates of the project area.
});


///append area in dropdown
function addSelectedArea(Area){
  var counts = $('#selected_area option').length;
  var counter = counts + 1;
  var message = "Add a " + Area + "?";
  
  if(confirm(message)){
    $.ajax({
      url: "{{route('createNewGUID')}}",
      success: function(response){
        $("#selected_area").append('<option value='+ Area + '__' + response  +' >' +counter+'</option>');

        var area_append = "<tr class='row_"+ counter +"'>";
        area_append += "<td>"+counter+"</td>";
        area_append += '<td><button type="button" class="btn btn-default" id="map-view" data-toggle="modal" data-target="#modal-default"><img src="../img/globe.jpg" style="width:17px;" /></button></td>';
        area_append += "</tr>";

        $("#geocoordinate_body_area").append(area_append);
      }
    });
  }else{
    return false;
  }
}


function lat( str ){
  var latInp = document.getElementById('deg_lat');
  if(str.length == 2){
    latInp.value = str+'°';
  } if(str.length == 6){
    latInp.value = str+"'";
  } if(str.length == 10){
    latInp.value = str+'.';
  } 
}

function long( str ){
  var longInp = document.getElementById('deg_long');
  if(str.length == 3){
    longInp.value = str+'°';
  } if(str.length == 7){
    longInp.value = str+"'";
  } if(str.length == 11){
    longInp.value = str+'.';
  } 
}

function decimalLat( str ){
  var DeclatInp = document.getElementById('deci_lat');
  if(str.length == 2){
    DeclatInp.value = str+'.';
  } 
}

function decimalLong( str ){
  var DeclatInp = document.getElementById('deci_long');
  if(str.length == 3){
    DeclatInp.value = str+'.';
  } 
}


function DDtoDMS(dec)
{
    // Converts decimal format to DMS ( Degrees / minutes / seconds ) 
    
    vars = dec.split(".");
    
    var deg = vars[0];
    
    var tempma = "0." + vars[1];
    var tempmas = tempma * 60;

    minsplit = tempmas.toString().split(".");

    var min = minsplit[0];

    var tempsec = "0." + minsplit[1];
    tempsec = tempsec * 60;

    var sec = tempsec[0];

    var DMS = deg + '°' + min + "'" +  tempsec.toFixed(2);;

    return DMS;
  } 

  function DMStoDD(dms)
  {
    // Converts DMS( Degrees / minutes / seconds )  to decimal format
    vars = dms.split("°");
    var deg = vars[0];
    
    var tempma = vars[1];
    minsplit = tempma.split("'");

    var min = minsplit[0] / 60;

    var tempsec = minsplit[1];

    var sec = tempsec / 3600;

    var decimal_point = min + sec;

    var decimal = parseInt(deg) + parseFloat(decimal_point) ;

    return decimal
  } 

  function RemoveArea(){
    var message = 'Removing the selected project area will also delete its geo-coordinates. Do you want to continue?';
    var selected_area = $('#selected_area option:selected').text();
    var selected_area_val = $('#selected_area option:selected').val();
    var deleteRow = '.row_' + selected_area;
    
    Swal.fire({
      title: 'Are you sure?',
      text: "Removing the selected project area will also delete its geo-coordinates. Do you want to continue?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm'
    }).then((result) => {
      if (result.dismiss || result.isConfirmed) {
        $(deleteRow).remove();
        $("#selected_area option[value='"+selected_area_val +"']").remove();
      }
    });
  }

  function clickMe(latitude, longitude)
  {
    var coords = latitude + "," + longitude;

    var url = 'https://maps.google.com/maps?q='+ coords +'&z=18&ie=UTF8&iwloc=&output=embed';
    var iframe = '<iframe id="googlemap"  src="'+url+'"width="1000" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

    Swal.fire({
      html: iframe,
      showCloseButton: true,
      showCancelButton: false,
      focusConfirm: false,
      showConfirmButton: false,
      width: 1100,
    })
  }

  function modalMessage(successMessage, errorMessage)
  {
    var text = '';

    $.each(errorMessage, function(index, value ) {
      text += '<div class="align-left"><b>Area:</b> <i>' + value['Area'] + '</i> | <b>Type:</b> <i>' + value['AreaType'] + '</i> | <i>invalid coordinates count</i><br></div>';
    });

    Swal.fire({
      icon: 'error',
    // title: 'Oops...',
    html : text,
    text: 'Something went wrong!',
    showConfirmButton: true,
    timer: 2000,
    width: '850px',
    footer: '<a class="pointer" onClick="whyDoIHaveThisIssue()">Why do I have this issue?</a>'
  }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss || result.isConfirmed) {
      location.reload();
    }
  });
}

function whyDoIHaveThisIssue()
{
  Swal.fire({
    title: '<strong>Information</strong>',
    icon: 'info',
    html:
    '<b>Area Type</b>: <i>Polygon, needs 3 or more coordinates (Longitude, Latitude) </i><br>' +
    '<b>Area Type</b>: <i>Line, needs 2 coordinates (Longitude, Latitude) </i>',
    showCloseButton: false,
    showCancelButton: false
  })
}

function checkSucessErrorMessage()
{
  var successMessage = [];
  var errorMessage = [];
  
  $.ajax({
    url: "{{route('getGeoTable')}}",
    type: 'GET',
    success: function(response){

      const groupedData = response.reduce((acc, curr) => {
        (acc[curr[0]] = acc[curr[0]] || []).push(curr);
        return acc;
      }, {});

      $.each(groupedData, function(index, value1 ) {
        if(value1[0][1].toUpperCase() == 'POLYGON' && value1.length >= 3){
          successMessage.push(
          {
            'Area' : value1[0][0],
            'AreaType' : value1[0][1],
            'Counter' : value1.length
          });
        } else if(value1[0][1].toUpperCase() == 'LINE' && value1.length == 2){
          successMessage.push(
          {
            'Area' : value1[0][0],
            'AreaType' : value1[0][1],
            'Counter' : value1.length
          } );
        } else {
          errorMessage.push(
          {
            'Area' : value1[0][0],
            'AreaType' : value1[0][1],
            'Counter' : value1.length
          });
        }
      });


      if(Object.keys(errorMessage).length > 0){
        modalMessage(successMessage, errorMessage);
      }  else {
        Swal.fire({
          icon: 'success',
          title: 'Step 4 is already saved in the session.',
          showDenyButton: false,
          showCancelButton: false,
          confirmButtonText: 'Confirm',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.dismiss || result.isConfirmed) {
            $("#step_4").css({"background-color":"#3c8dbc", "color": "#ffffff"});

            $('#myTab li a')[4].click();
            
            location.reload();
          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
          }
        })
      }
    }
  });
}

function proceedNextStep()
{
  var data = $('#ProjectGeoCoordinatesTable').DataTable()
  .rows()
  .data()
  .toArray();

  const array_check = [];

  if(data.length > 0){
    $("#li_step_5").attr("class", "able");
    $("#step_5").attr("data-toggle", "tab");
    $.ajax({
      url: "{{route('FourthStep')}}",
      type: 'POST',
      data: {
        data : data,
        fourth : 1,
        _token: '{{csrf_token()}}',
      },
      success: function(response){
        checkSucessErrorMessage();
      }
    });

  } else {
    $.ajax({
      url: "{{route('FourthStep')}}",
      type: 'POST',
      data: {
        data : '',
        fourth : 0,
        _token: '{{csrf_token()}}' ,
      },
      success: function(response){
        
        Swal.fire({
          icon: 'error',
          title: 'Notifications!',
          text: 'Something went wrong while saving your GeoCoordinates!',
          width: '850px'
        });

        $("#step_4").css({"background-color":"#dd4b39", "color": "#ffffff"});
      }
    });
  }
}


function Maps()
{
  
  var arr1 = [];
  var arr = [];
  
  $.ajax({
    url: "{{route('getGeoTable')}}",
    type: 'GET',
    success: function(response){
      var Area;

      $.each(response, function(index, value ) {

        //now you can access properties using dot notation
        var html_code = "<tr class='row_"+value[0]+"'>";
        html_code += "<td>"+value[0]+"</td>";
        html_code += "<td>"+value[1]+"</td>";
        html_code += "<td>"+value[2]+"</td>";
        html_code += "<td>"+value[3]+"</td>";
        html_code += "<td>"+value[4]+"</td>";
        html_code += "<td>"+value[5]+"</td>";
        html_code += '<td><button type="button" class="btn btn-default" id="remove" title="delete coordinates"><img src="../img/trashbin.jpg" style="width:15px;" /></button></td>';
        html_code += '<td><button type="button" class="btn btn-default" id="map-view"       onclick="clickMe('+value[4]+', '+"'"+value[5]+"'"+')" title="view by point"><img src="../img/map.png" style="width:17px;" /></button></td>';
        html_code += "<td hidden>"+value[8]+"</td>";
        html_code += "</tr>";
        

        $("#geocoordinate_body").append(html_code);

        arr1.push([parseFloat(value[4]) , parseFloat(value[5]) ]);
      });

      var centerPoint = getCenterPoint(arr1);
      var popup = L.popup();

      var map = L.map('map').setView(centerPoint, 18);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 45,
        crossOrigin: true,
      }).addTo(map);

      map.on("click", function(event) {

        var lat = event.latlng.lat;
        var lng = event.latlng.lng;

        $("#deci_lat").val(lat);
        $("#deci_long").val(lng);

        popup
        .setLatLng(event.latlng)
        .setContent("You clicked the map at " + event.latlng.toString())
        .openOn(map);
      });

      const groupedData = response.reduce((acc, curr) => {
        (acc[curr[0]] = acc[curr[0]] || []).push(curr);
        return acc;
      }, {});

      var ctr = 0;

      $.each(groupedData, function(index, value1 ) {
        ctr++;
        arr[ctr] = [];

        var Area = value1[0][0];
        var AreaType = value1[0][1];
        var GUID = value1[0][9];

        $("#selected_area").append('<option value="'+ AreaType + '__' + GUID  +'" >' +Area+'</option>');

        var area_append = "<tr class='row_"+ Area +"'>";
        area_append += "<td>"+Area+"</td>";
        area_append += '<td><button type="button" class="btn btn-default" id="map-view" onClick="modalPolyLine('+Area+')"><img src="../img/globe.jpg" style="width:17px;" /></button></td>';
        area_append += "</tr>";

        $("#geocoordinate_body_area").append(area_append);

        $.each(value1, function(index, value2 ) {
          if(value2[0] == Area){
            areaType = value2[1];
            arr[ctr].push([parseFloat(value2[4]) , parseFloat(value2[5]) ]);
          }
        });

        var polygon = L.polygon(
          arr[ctr]
          ).addTo(map).bindPopup("I am a polygon.");

        polygon.bindPopup("Area " + Area + ': ' + areaType).openPopup();

        $('a[href="' + hash + '"]').on('shown.bs.tab', function(e) {
          map.invalidateSize();
        });
      });
    }
  });
}

function ShapesPreview(){
  ;

  window.open('/google_map', '_blank');
}
</script>