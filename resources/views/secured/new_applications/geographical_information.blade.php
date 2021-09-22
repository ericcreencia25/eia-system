    <div class="box-body">
      <h4><b>4. PROJECT GEOGRAPHICAL INFORMATION</b><br></h4>
      <i>
        Select from the shape icon below to add the project area (triangle - for polygon area, Line icon - for bridge, roads etc). Click only once if you only have (1) project area. The project area number will appear in the list. If you have MORE THAN (1) project area, make sure you have selected the appropriate project area number from the list before adding the geo-coordinate (latitude and longitude). Please add the coordinates in sequence. You may have to pad/add '0' if the coordinate has fewer digits. For consistency purposes, please use the World Geodetic System 1984 (WGS84) Datum Convention. Mobile Phones and most online maps are using this convention by default.
      </i>
      <br><br>
      <div style="border:Solid 1px Silver;">
        <div style=" background-color:#C3D1E6; ">
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
                <td> <input type="image" name="" id="" title="Click to add a polygon" src="../img/polygon.PNG" onclick="return confirm('Add a polygon?');" style="background-color:White;width:30px;"> 
                </td>
                <td> 
                  <input type="image" name="" id="" title="Click to add a line" src="../img/line.PNG" onclick="return confirm('Add a line?');" style="background-color:White;width:30px;">
                </td>
                <td style="padding-left:30px;">
                  <select name="" id="" style="width:50px;">
                    <option selected="selected" value="">1</option>
                  </select>
                </td>
                <td>
                  <select name="" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$geoFormat\',\'\')', 0)" id="" style="width:130px;">
                    <option value="0">Decimal</option>
                    <option selected="selected" value="1">Deg-Min-Sec</option>
                  </select>
                </td> 
                <td style="padding-left:30px;">Geo-Coordinate</td>
                <td>
                  <input name="" type="text" value="__°___'___.____&quot;" id="" onkeydown="return (event.keyCode!=13);" class="">
                  <input type="hidden" name="" id="">
                </td> 
                <td>
                  <input name="" type="text" value="___°___'___.____&quot;" id="" onkeydown="return (event.keyCode!=13);">
                  <input type="hidden" name="" id="">
                </td>
                <td>
                  <input type="submit" name="" class="btn btn-block btn-flat btn-success" value="Add Point " id="" title="Click to add point">
                </td>
                <td style="padding-left:50px;">
                  <input type="submit" name="" value="Remove Area " onclick="return confirm('Removing the selected project area will also delete its geo-coordinates. Do you want to continue?');" id="" title="Click to remove the selected area" class="btn btn-block btn-flat btn-warning">
                </td>
                <td>
                  &nbsp;&nbsp;
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
            <tbody>
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

  $(document).ready(function(){
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
</script>