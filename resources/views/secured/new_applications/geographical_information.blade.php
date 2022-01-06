    <div class="box-body">
      <h4><b>4. PROJECT GEOGRAPHICAL INFORMATION</b><br></h4>
      <i>
        Select from the shape icon below to add the project area (triangle - for polygon area, Line icon - for bridge, roads etc). Click only once if you only have (1) project area. The project area number will appear in the list. If you have MORE THAN (1) project area, make sure you have selected the appropriate project area number from the list before adding the geo-coordinate (latitude and longitude). Please add the coordinates in sequence. You may have to pad/add '0' if the coordinate has fewer digits. For consistency purposes, please use the World Geodetic System 1984 (WGS84) Datum Convention. Mobile Phones and most online maps are using this convention by default.
      </i>
      <br><br>
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
              <input type="text" placeholder="___°___'___.____&quot;" id="deg_long" name="deg_long" onkeypress="long(this.value)" maxlength="17">

              <input type="text" name="deci_long" id="deci_long" placeholder="___.__________" maxlength="17" onkeypress="decimalLong(this.value)">
            </td>
            <td>
              <input type="submit" name="" class="btn btn-block btn-flat btn-success" value="Add Point " id="add_point" title="Click to add point">
            </td>
            <td style="padding-left:50px;">
              <input type="submit" name="" value="Remove Area " onclick="return confirm('Removing the selected project area will also delete its geo-coordinates. Do you want to continue?');" id="" title="Click to remove the selected area" class="btn btn-block btn-flat btn-warning">
            </td>
            <td>&nbsp;&nbsp;
              <input type="image" name="" id="" title="Click here to view in map" class="imgbutton" src="../img/globe.jpg" style="background-color:White;width:35px;">
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
        </thead>
        <tbody id="geocoordinate_body">

        </tbody>
      </table>
    </div>
  </div>
</div>

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
var ProjectGUID = "{{$project['ProjectGUID']}}";

  $(document).ready(function() {
  $("#deci_lat").hide();
  $("#deci_long").hide();

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

  $("#add_point").click(function() {
    var count = 1;
    var geo_format = $('#geo_format').val();

    var selected_area_txt = $("#selected_area option:selected").text();
    var selected_area_val = $("#selected_area").val();
    var geo_format = $('#geo_format').val();

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

    count = count + 1;

    if(selected_area_val != null){
      var html_code = "<tr id='row_"+count+"'>";
      html_code += "<td>"+selected_area_txt+"</td>";
      html_code += "<td>"+selected_area_val+"</td>";
      html_code += "<td>"+dms_latitude+"</td>";
      html_code += "<td>"+dms_longitude+"</td>";
      html_code += "<td>"+decimal_latitude+"</td>";
      html_code += "<td>"+decimal_longitude+"</td>";
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

  $('#check_step_4').on("click", function() {
    $("#li_step_5").attr("class", "able");
    $("#step_5").attr("data-toggle", "tab");

        // $("#check_step_1").attr("class", "btn btn btn-sm btn-success");
    $("#check_step_4").hide();
    $("#proceed_4").html('<span class="label label-success">Proceed to next step</span>');
  });

  $('#ProjectGeoCoordinatesTable').DataTable({
      processing:true,
      info:true,
      ajax: {
            "url": "{{route('getGeoCoordinates')}}",
            "type": "POST",
            "data": {
                data : ProjectGUID,
                _token: '{{csrf_token()}}' ,
            }, 
        },
      columns: [
        {data: 'Area', name: 'Area'},
        {data: 'Type', name: 'Type'},
        {data: 'DMSLatitude', name: 'DMSLatitude'},
        {data: 'DMSLongitude', name: 'DMSLongitude'},
        {data: 'Latitude', name: 'Latitude'},
        {data: 'Longitude', name: 'Longitude'},
        {data: 'Action', name: 'Action'},
      ]
    });


});



function addSelectedArea(Area){
  var counts = $('#selected_area option').length;
  var counter = counts + 1;
  var message = "Add a " + Area + "?";
  
  if(confirm(message)){
        $("#selected_area").append('<option value='+ Area +'>' +counter+'</option>');
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
  } if(str.length == 15){
    latInp.value = str+'"';
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
  } if(str.length == 16){
    longInp.value = str+'"';
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
    minsplit = tempma.toString().split("'");
    var min = minsplit[0] / 60;

    var tempsec = minsplit[1];
    var sec = tempsec / 3600;

    var decimal_point = min + sec;

    var decimal = parseInt(deg) + parseFloat(decimal_point) ;

    return decimal
} 

</script>