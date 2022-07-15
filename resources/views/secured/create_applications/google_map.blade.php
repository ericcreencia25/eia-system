<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />


  

  <link rel="stylesheet" href="../../adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="../../adminlte/dist/css/skins/_all-skins.min.css">

     <!-- Bootstrap 3.3.7 -->
     <!-- <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


     <link rel="stylesheet" href="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7/leaflet.css" />

     <link rel="stylesheet" href="../../adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

     <script src="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7/leaflet.js">
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js">
     </script>

     <!-- jQuery 3 -->
     <script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>

     <script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
     <script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
     <style>
      /*#map {position: absolute; top: 0; right: 0; bottom: 0; left: 0;}*/
    </style>
  </head>
  <body>
    <div class="col-md-12">
      <div id="map" style="width: 100%; height: 660px;">
        <!-- <a href="https://www.maptiler.com" style="position:absolute;left:10px;bottom:10px;z-index:999;"><img src="https://api.maptiler.com/resources/logo.svg" alt="MapTiler logo"></a>
        <div class="leaflet-bottom leaflet-right">
            <input type="button" id="Save" value="Save" class="leaflet-control btn-primary btn-lg pull-right"  style="height: 50px; width: 100px; margin-bottom: 400px" /> 
          </div> -->
        </div>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered" id="ProjectGeoCoordinatesTable" style="width: 100%">
          <thead>
            <th>Area</th>
            <th>Type</th>
            <th>DMS Latitude</th>
            <th>DMS Longitude</th>            
            <th>Decimal Latitude</th>
            <th>Decimal Longitude</th>
            <th hidden></th>
            <th hidden></th>
            <th hidden></th>
          </thead>
          <tbody id="geocoordinate_body">

          </tbody>
        </table>
      </div>
      <script>

        $(document).ready(function() {

         MapsViewShapes();     

         $("#Save").on('click', function() {
          alert('SS');
        });
       });

        function getCenterPoint(arr)
        {
          var minX, maxX, minY, maxY;

          for (var i = 0; i < arr.length; i++)
          {
            minX = (arr[i][0] < minX || minX == null) ? arr[i][0] : minX;
            maxX = (arr[i][0] > maxX || maxX == null) ? arr[i][0] : maxX;
            minY = (arr[i][1] < minY || minY == null) ? arr[i][1] : minY;
            maxY = (arr[i][1] > maxY || maxY == null) ? arr[i][1] : maxY;
          }
          
          return [(minX + maxX) / 2, (minY + maxY) / 2];
        }

        function MapsViewShapes()
        {
          var arr1 = [];
          var arr = [];

          $.ajax({
            url: "{{route('getGeoTable')}}",
            type: 'GET',
            success: function(response){
              var Area;


      //get all the data for centering
      $.each(response, function(index, value ) {
        //now you can access properties using dot notation
        var html_code = "<tr class='row_"+value[0]+"'>";
        html_code += "<td>"+value[0]+"</td>";
        html_code += "<td>"+value[1]+"</td>";
        html_code += "<td>"+value[2]+"</td>";
        html_code += "<td>"+value[3]+"</td>";
        html_code += "<td>"+value[4]+"</td>";
        html_code += "<td>"+value[5]+"</td>";
        html_code += '<td hidden><button type="button" class="btn btn-default" id="remove" title="delete coordinates"><img src="../img/trashbin.jpg" style="width:15px;" /></button></td>';
        html_code += '<td hidden><button type="button" class="btn btn-default" id="map-view"       onclick="clickMe('+value[4]+', '+"'"+value[5]+"'"+')" title="view by point"><img src="../img/map.png" style="width:17px;" /></button></td>';
        html_code += "<td hidden>"+value[8]+"</td>";
        html_code += "</tr>";
        

        $("#geocoordinate_body").append(html_code);

        arr1.push([parseFloat(value[4]) , parseFloat(value[5]) ]);
      });

      var centerPoint = getCenterPoint(arr1);
      var popup = L.popup();

      var map = L.map('map').setView(centerPoint, 8);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 45,
        crossOrigin: true,
      }).addTo(map);

      const groupedData = response.reduce((acc, curr) => {
        (acc[curr[0]] = acc[curr[0]] || []).push(curr);
        return acc;
      }, {});

      var ctr = 0;

      ///draw shapes in the map
      $.each(groupedData, function(index, value1 ) {
        ctr++;
        arr[ctr] = [];

        var Area = value1[0][0];
        var AreaType = value1[0][1];
        var GUID = value1[0][9];

        $.each(value1, function(index, value2 ) {
          if(value2[0] == Area){
            areaType = value2[1];
            arr[ctr].push([parseFloat(value2[4]) , parseFloat(value2[5]) ]);
          }
        });

        if(areaType.toUpperCase() == 'POLYGON'){
          var polygon = L.polygon(arr[ctr], {color: 'purple'}).addTo(map).bindPopup("I am a polygon.");
          polygon.bindPopup("Area " + Area + ': ' + areaType).openPopup();

        } else {
          var polyline = L.polyline(arr[ctr], {color: 'red'}).addTo(map).bindPopup("I am a polygon.");
          polyline.bindPopup("Area " + Area + ': ' + areaType).openPopup();
        }

        

      });

    }
  });

        }
      </script>
    </body>
    </html>