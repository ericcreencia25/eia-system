<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
  <link rel="stylesheet" href="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7/leaflet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7/leaflet.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js">
  </script>

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
      <!-- <p><a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a></p> -->
      <script>

        $(document).ready(function() {
          MapsViewShapes(); 
    // var arrayData = [];
    // ///Setting the center of the map
    // var center = [12.8797, 121.7740];
    // // Create the map
    // var map = L.map('map').setView(center, 10);
    // // Set up the Open Street Map layer 
    // L.tileLayer(
    //   'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
    //     maxZoom: 45,
    //     crossOrigin: true,
    //   }).addTo(map);

    // // L.marker([38.9188702,-77.0708398]).addTo(newMap);

    // // var polyline = L.polyline(latlngs, {color: 'red'});

    // // var rectOptions = {color: 'green', weight: 1}
    // // var rectangle = L.rectangle(latlngs, rectOptions);

    // // var polygon = L.polygon([
    // //   [13.1155925540513, 122.48245239257812 ],
    // //   [13.270689685634224, 122.48245239257812 ],
    // //   [13.270689685634224, 122.65274047851562 ],
    // //   ], {color: 'purple'}).addTo(map);

    // // var polygon = L.polygon(Platlngs, {color: 'purple'}).addTo(map).bindPopup("I am a polygon.");

    // var drawnItems = new L.FeatureGroup();
    //     map.addLayer(drawnItems);

    // var drawControl = new L.Control.Draw({
    //   position: 'topright',
    //   draw: {
    //     polygon: {
    //       shapeOptions: {
    //         color: 'purple' //polygons being drawn will be purple color
    //       },
    //       allowIntersection: false,
    //       drawError: {
    //         color: 'orange',
    //         timeout: 1000
    //       },
    //       showArea: true, //the area of the polygon will be displayed as it is drawn.
    //       metric: false,
    //       repeatMode: true
    //     },
    //     polyline: {
    //       shapeOptions: {
    //         color: 'red'
    //       },
    //     },
    //     circlemarker: false, //circlemarker type has been disabled.
    //     // rect: {
    //     //   shapeOptions: {
    //     //     color: 'green'
    //     //   },
    //     // },
    //     rectangle: false,
    //     circle: false,
    //     marker: false,
    //   },
    //   edit: {
    //     featureGroup: drawnItems
    //   }
    // });

    // map.addControl(drawControl);
    // // map.on('draw:created', function(e) {

    // //   var type = e.layerType,
    // //       layer = e.layer;

    // //   if(type == 'marker'){
    // //     longlat = e.layer._latlng;
    // //   }else{
    // //     longlat = e.layer._latlngs;
    // //   }

    // //   // console.log(longlat);

    // //   $.each(longlat, function(index, value ) {
    // //     lng = value.lng;
    // //     lat = value.lat;

    // //     console.log(lng);
    // //     console.log(lat);
    // //   });
    

    // //   // arrayData.push([1, type, ])

    // //   drawnItems.addLayer(layer);
    // //   $('#polygon').val(JSON.stringify(layer.toGeoJSON())); //saving the layer to the input field using jQuery
    // // });

    // map.on('draw:created', function (e) {
    //   var type = e.layerType,
    //       layer = e.layer;

    //       console.log(e);

    //     if(type == 'marker'){
    //       latlngs = e.layer._latlng;
    //     }else{
    //       latlngs = e.layer._latlngs;
    //     }

    //     // structure the geojson object
    //     var geojson = {};
    //     geojson['type'] = 'Feature';
    //     geojson['geometry'] = {};
    //     geojson['geometry']['type'] = type;

    //     // export the coordinates from the layer
    //     coordinates = [];
    //     latlngs = layer.getLatLngs();
    
    //     for (var i = 0; i < latlngs.length; i++) {
    //       coordinates.push([latlngs[i].lng, latlngs[i].lat])
    //     }

    //     // push the coordinates to the json geometry
    //     geojson['geometry']['coordinates'] = [coordinates];

    //     console.log(geojson);

    //     arrayData.push(geojson)

    //     // Finally, show the poly as a geojson object in the console
    //     // console.log(JSON.stringify(geojson));
    //     drawnItems.addLayer(layer);
    //   });

    // map.on('draw:edited', function (e) {
    //   var type = e.layerType,
    //       layer = e.layer;

    //       console.log(e);

    //     // if(type == 'marker'){
    //     //   latlngs = e.layer._latlng;
    //     // }else{
    //     //   latlngs = e.layer._latlngs;
    //     // }

    //     // // structure the geojson object
    //     // var geojson = {};
    //     // geojson['type'] = 'Feature';
    //     // geojson['geometry'] = {};
    //     // geojson['geometry']['type'] = type;

    //     // // export the coordinates from the layer
    //     // coordinates = [];
    //     // latlngs = layer.getLatLngs();
    
    //     // for (var i = 0; i < latlngs.length; i++) {
    //     //   coordinates.push([latlngs[i].lng, latlngs[i].lat])
    //     // }

    //     // // push the coordinates to the json geometry
    //     // geojson['geometry']['coordinates'] = [coordinates];

    //     // console.log(geojson);

    //     // arrayData.push(geojson)

    //     // // Finally, show the poly as a geojson object in the console
    //     // // console.log(JSON.stringify(geojson));
    //     // drawnItems.addLayer(layer);
    //  });

    // map.on('draw:deleted', function (e) {
    //   console.log(e);
    // });



    // $("#Save").on('click', function() {
    //   // alert('SS');
    //   console.log(arrayData);
    // });
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

      var drawnItems = new L.FeatureGroup();
      map.addLayer(drawnItems);

      var drawControl = new L.Control.Draw({
        position: 'topright',
        draw: {
          polygon: {
            shapeOptions: {
              color: 'purple' //polygons being drawn will be purple color
            },
            allowIntersection: false,
            drawError: {
              color: 'orange',
              timeout: 1000
            },
            showArea: true, //the area of the polygon will be displayed as it is drawn.
            metric: false,
            repeatMode: true
          },
          polyline: {
            shapeOptions: {
              color: 'red'
            },
          },
          circlemarker: false, //circlemarker type has been disabled.
          // rect: {
          //   shapeOptions: {
          //     color: 'green'
          //   },
          // },
          rectangle: false,
          circle: false,
          marker: false,
        },
        edit: {
          featureGroup: drawnItems
        }
      });

      map.addControl(drawControl);
      map.on('draw:created', function(e) {

        var type = e.layerType,
        layer = e.layer;

        if(type == 'marker'){
          longlat = e.layer._latlng;
        }else{
          longlat = e.layer._latlngs;
        }

        // console.log(longlat);

        $.each(longlat, function(index, value ) {
          lng = value.lng;
          lat = value.lat;

          console.log(lng);
          console.log(lat);
        });
        

        // arrayData.push([1, type, ])

        drawnItems.addLayer(layer);
        $('#polygon').val(JSON.stringify(layer.toGeoJSON())); //saving the layer to the input field using jQuery
      });

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