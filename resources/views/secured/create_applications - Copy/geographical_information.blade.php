<div class="box-body">
  <div>
    <button type="button" class="btn btn btn-primary pull-right" id="check_step_4">Save <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>4. PROJECT GEOGRAPHICAL INFORMATION: 

    <span id="proceed_4"></span>
  </b><br></h4>
  <i>Select from the shape icon below to add the project area (triangle - for polygon area, Line icon - for bridge, roads etc). Click only once if you only have (1) project area. The project area number will appear in the list. If you have MORE THAN (1) project area, make sure you have selected the appropriate project area number from the list before adding the geo-coordinate (latitude and longitude). Please add the coordinates in sequence. You may have to pad/add '0' if the coordinate has fewer digits. For consistency purposes, please use the World Geodetic System 1984 (WGS84) Datum Convention. Mobile Phones and most online maps are using this convention by default.</i><br><br>
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
            <td> <input type="image" name="" id="" title="Click to add a polygon" src="../img/polygon.PNG" onclick="addSelectedArea('polygon')" style="background-color:White;width:30px;"> 
            </td>
            <td> 
              <input type="image" name="" id="" title="Click to add a line" src="../img/line.PNG" onclick="addSelectedArea('line')" style="background-color:White;width:30px;">
            </td>
            <td style="padding-left:30px;">
              <select name="" id="selected_area" style="width:50px;">
                <!-- <option selected="selected" value=""></option> -->
              </select>
            </td>
            <td>
              <select name="" id="geo_format" style="width:130px;">
                <option value="0">Decimal</option>
                <option selected="selected" value="1">Deg-Min-Sec</option>
              </select>
            </td>
            <td style="padding-left:30px;">Geo-Coordinate</td>
            <td>
              <input type="text" placeholder="__°___'___.____&quot;" id="deg_lat" name="deg_lat" onkeypress="lat(this.value)" maxlength="16">

              <input type="text" name="deci_lat" id="deci_lat" placeholder="__.__________" maxlength="16" onkeypress="decimalLat(this.value)">
            </td>
            <td>
              <input type="text" placeholder="___°___'___.____&quot;" id="deg_long" name="deg_long" onkeypress="long(this.value)" maxlength="16">

              <input type="text" name="deci_long" id="deci_long" placeholder="___.__________" maxlength="16" onkeypress="decimalLong(this.value)">
            </td>
            <td>
              <input type="submit" name="" class="btn btn-block btn-flat btn-success" value="Add Point " id="add_point" title="Click to add point">
            </td>
            <td style="padding-left:50px;">
              <input type="submit" name="" value="Remove Area " onclick="RemoveArea()" id="" title="Click to remove the selected area" class="btn btn-block btn-flat btn-warning">
            </td>
            <td>&nbsp;&nbsp;
              <input type="image" name="" id="" title="Click here to view in map" class="imgbutton" src="../img/globe.jpg" style="background-color:White;width:35px;" onclick="MapView()">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="box-body no-padding">
      <table class="table table-striped" id="ProjectGeoCoordinatesTable" style="width: 100%">
        <thead>
          <th>Area</th>
          <th>Type</th>
          <th>DMS Latitude</th>
          <th>DMS Longitude</th>            
          <th>Decimal Latitude</th>
          <th>Decimal Longitude</th>
          <th></th>
          <th hidden></th>
        </thead>
        <tbody id="geocoordinate_body">

        </tbody>
      </table>
    </div>
    <div id="world-map-markers" style="width: 100%; height: 325px;"></div>
  </div>
</div>
<div class="modal fade" id="map-modal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Click the the link below to view the attachment.</h4>
              </div>
              <div class="modal-body">
                <div id="world-map-markers" style="width: 100%; height: 100%;"></div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<script>
$(document).ready(function() {

  $("#world-map-markers").vectorMap({
    map: 'ph_mill_en'
  });
  var url=window.location.pathname;
  var arr=url.split('/');
  var NewGUID=arr[2];
  
  $("#deci_lat").hide();
  $("#deci_long").hide();

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
      html_code += "<td>"+dms_latitude+ '"' + "</td>";
      html_code += "<td>"+dms_longitude+ '"' + "</td>";
      html_code += "<td>"+decimal_latitude+"</td>";
      html_code += "<td>"+decimal_longitude+"</td>";
      html_code += '<td><button type="button" class="btn btn-danger">Remove</button></td>';
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

    $.ajax({
        url: "{{route('getGeoTable')}}",
        type: 'GET',
        success: function(response){
          $.each(response, function(index, value ) {
            //now you can access properties using dot notation
            var html_code = "<tr class='row_"+value[0]+"'>";
            html_code += "<td>"+value[0]+"</td>";
            html_code += "<td>"+value[1]+"</td>";
            html_code += "<td>"+value[2]+ '"' + "</td>";
            html_code += "<td>"+value[3]+ '"' + "</td>";
            html_code += "<td>"+value[4]+"</td>";
            html_code += "<td>"+value[5]+"</td>";
            html_code += '<td><button type="button" class="btn btn-danger" id="remove">Remove</button></td>';
            html_code += "<td hidden>"+value[7]+"</td>";
            html_code += "</tr>";
            $("#geocoordinate_body").append(html_code);
          });
        }
      });


    $.ajax({
      url: "{{route('selectedArea')}}",
        type: 'POST',
        data: {
          ProjectGUID : NewGUID,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          $.each(response['data'], function(index, value ) {
            //now you can access properties using dot notation
            var Area = value['Area'];
            var AreaType = value['AreaType'];
            var GUID = value['GUID'];

            $("#selected_area").append('<option value="'+ AreaType + '__' + GUID  +'" >' +Area+'</option>');
          });
        }
      });
  } else if(step4_check == 0){
    $("#step_4").css({"background-color":"#dd4b39", "color": "#ffffff"});
  } else if(step4_check == "N/A"){
    // $("#step_4").css({"background-color":"#fff", "color": "#444"});
  }

  $('.table tbody').on('click', '#remove', function() { 
    $(this).closest('tr').remove();
  });


  /// onclick of proceed: save to session
  $('#check_step_4').on("click", function() {

    var data = $('#ProjectGeoCoordinatesTable').DataTable()
      .rows()
      .data()
      .toArray();
    const array_check = [];
    

    // Error Message
    // Line area should have at least two (2) geo-coordinates.
    //Polygon area should have at least three (3) geo-coordinates.

    // $.each(data, function(index, value ) {
    //   let counter = index + 1; 

    //   $.inArray(val, arr, 4);

    //   if($.inArray(['1', 'polygon'], array_check) ) { // do stuff 
    //     array_check.push([value[0], value[1]]);
    //   }

      
    //   // console.log(value[0]);
    //   // console.log(value[1]);
    // });

    // console.log(array_check);

    if(data.length > 0){
      $("#li_step_5").attr("class", "able");
      $("#step_5").attr("data-toggle", "tab");
      $.ajax({
        url: "{{route('FourthStep')}}",
        type: 'POST',
        data: {
          data : data,
          fourth : 1,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          toastr.success('Saved! ');
          $("#step_4").css({"background-color":"#3c8dbc", "color": "#ffffff"});
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
          toastr.error("ERROR");
          $("#step_4").css({"background-color":"#dd4b39", "color": "#ffffff"});
        }
      });
    }
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

    var DMS = deg + '°' + min + "'" + tempsec;

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
  
  if(confirm(message)){
    $(deleteRow).remove();
    $("#selected_area option[value='"+selected_area_val +"']").remove();
  }else{
    return false;
  }
}

function MapView(){
  $("#map-modal").modal();
}
</script>