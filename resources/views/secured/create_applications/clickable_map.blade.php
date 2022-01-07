<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>PROJECT GEOGRAPHICAL INFORMATION</title>
  <style>
    html, body, #viewDiv {
      padding: 0;
      margin: 0;
      height: 100%;
      width: 100%;
    }
    #instruction {
      padding: 15px;
      background: white;
      color: black;
       border: 5px solid gold;
       font-family: sans-serif;
       font-size: 1.2em;
    }
    #addButton {
      padding: 15px;
      background: white;
      color: black;
       border: 5px solid gold;
       font-family: sans-serif;
       font-size: 1.2em;
    }
  </style>
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->

  <!-- daterange picker -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="../../adminlte/bower_components/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="../../adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../adminlte/bower_components/jvectormap/jquery-jvectormap.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../adminlte/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <link rel="stylesheet" href="https://js.arcgis.com/4.11/esri/css/main.css">
  <script src="https://js.arcgis.com/4.11/"></script>

  <script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../../adminlte/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../adminlte/dist/js/demo.js"></script>
  
  <script>
    var data = localStorage.getItem("ReqStorage");
    var ReqStorage = data ? JSON.parse(data) : [];
    var arrayPoly = [];
    var arrayPoly1 = [];
    var sessionArray = [];
    var center_location = [];

    var url=window.location.pathname;
    var arr=url.split('/');
    var NewGUID=arr[1];

    var stored = localStorage.getItem("ReqStorage");
        stored = JSON.parse(stored || '[]');
        ReqStorage.concat(stored);
        localStorage.setItem("ReqStorage", JSON.stringify(ReqStorage));

    if(stored.length > 0){
      var description = stored[0]['description'];
      var number = stored[0]['number'];
    } else {
      var description = '' ;
      var number = '';
    }


    ///check if there's already an input in session
    var step4_check = "{{ Session::has('step_4_status') ? Session::get('step_4_status') : 'N/A' }}";

    if(step4_check == 1){
      $.ajax({
        url: "{{route('getGeoTable')}}",
        type: 'GET',
        success: function(response){
          center_location.push(response[0][5], response[0][4]);

          $.each(response, function(index, value ) {
            if(value[0] == number){
              arrayPoly1.push([value[5], value[4]]);
            }
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

            if(Area == number){
              $("#selected_area").append('<option value="'+ AreaType + '__' + GUID  +'" selected="selected">' +Area+'</option>');
            } else {
              $("#selected_area").append('<option value="'+ AreaType + '__' + GUID  +'">' +Area+'</option>');
            }
          });
        }
      });
    }else{
      center_location.push(120.9826, 14.5353);
    }

    require([
        "esri/tasks/Locator",
        "esri/Map",
        "esri/views/MapView",
        "esri/Graphic",
        "esri/layers/GraphicsLayer"
    ], function(Locator, Map, MapView, Graphic, GraphicsLayer) {

      // Set up a locator task using the world geocoding service
      var locatorTask = new Locator({
        url:
          "https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer"
      });

      var map = new Map({
        basemap: "topo-vector"
      });

      var view = new MapView({
        container: "viewDiv",
        map: map,
        center: center_location, // longitude, latitude
        // center: [center_location], // longitude, latitude
        // center:[-118.821527826096, 34.0139576938577],
        zoom: 18
      });
      
       view.ui.add("instruction", "bottom-left");
       view.ui.add("addButton", "top-right");
      
      const graphicsLayer = new GraphicsLayer();
      map.add(graphicsLayer);   

      if(step4_check == 1){
        // Create a polygon geometry
        const polygon1 = {
          type: "polygon",
          rings: [arrayPoly1]
        };

        const simpleFillSymbol1 = {
          type: "simple-fill",
          color: [227, 139, 79, 0.8],  // Orange, opacity 80%
          outline: {
            color: [255, 255, 255],
            width: 1
          }
        };

        const polygonGraphic1 = new Graphic({
          geometry: polygon1,
          symbol: simpleFillSymbol1,
        });
        graphicsLayer.add(polygonGraphic1);
      }

      var simpleLineSymbol = {
         type: "simple-line",
         color: [226, 119, 40], // orange
         width: 2
       };

       var polyline = {
         type: "polyline",
         paths: [
           [-118.821527826096, 34.0139576938577],
           [-118.814893761649, 34.0080602407843],
           [-118.808878330345, 34.0016642996246]
         ]
       };

       var polylineGraphic = new Graphic({
         geometry: polyline,
         symbol: simpleLineSymbol
       });

       graphicsLayer.add(polylineGraphic);
       
      /*******************************************************************
      * This click event sets generic content on the popup not tied to
      * a layer, graphic, or popupTemplate. The location of the point is
      * used as input to a reverse geocode method and the resulting
      * address is printed to the popup content.
      *******************************************************************/
      
      view.popup.autoOpenEnabled = false;
      view.on("click", function(event) {
        var lat = Math.round(event.mapPoint.latitude * 1000) / 1000;
        var lon = Math.round(event.mapPoint.longitude * 1000) / 1000;

        arrayPoly.push([event.mapPoint.longitude, event.mapPoint.latitude]);
        sessionArray.push(['polygon',event.mapPoint.longitude, event.mapPoint.latitude]);

        // Create a polygon geometry
        const polygon = {
          type: "polygon",
          rings: [arrayPoly]
        };

        const simpleFillSymbol = {
          type: "simple-fill",
          color: [227, 139, 79, 0.8],  // Orange, opacity 80%
          outline: {
            color: [255, 255, 255],
            width: 1
          }
        };

        const polygonGraphic = new Graphic({
          geometry: polygon,
          symbol: simpleFillSymbol,
        });

        graphicsLayer.add(polygonGraphic);

        // Get the coordinates of the click on the view
        view.popup.open({
          // Set the popup's title to the coordinates of the location
          title: "Reverse geocode: [" + lon + ", " + lat + "]",
          location: event.mapPoint // Set the location of the popup to the clicked location
        });

        document.getElementById("instruction").innerHTML = "Lon: " + lon + " / Lat: " + lat; 

        // Display the popup
        // Execute a reverse geocode using the clicked location
        locatorTask
        .locationToAddress(event.mapPoint)
        .then(function(response) {
          // If an address is successfully found, show it in the popup's content
          view.popup.content = response.address;
        })
        .catch(function(error) {
          // If the promise fails and no result is found, show a generic message
          view.popup.content = "No address was found for this location";
        });
      });
    });


  </script>
</head>
<body>
  <div id="viewDiv"></div>
  <div id="instruction">
    Click on the map to retrieve coordinates and address
  </div>
  <div id="addButton">
    <table cellspacing="0" cellpadding="3" style="background-color:#C3D1E6;  ">
        <tbody>
          <tr style="font-size:7pt">
            <td colspan="2">Clik icon to Add Area</td>
            <td style="padding-left:30px;">Selected Area</td>
            <td style="padding-left:30px;"></td>
          </tr>
          <tr>
            <td> <input type="image" name="" id="" title="Click to add a polygon" src="../img/polygon.PNG" onclick="addSelectedArea('polygon')" style="background-color:White;width:30px;"> 
            </td>
            <td> 
              <input type="image" name="" id="" title="Click to add a line" src="../img/line.PNG" onclick="addSelectedArea('line')" style="background-color:White;width:30px;">
            </td>
            <td>
              <select name="" id="selected_area" style="width:50px;">
                <option selected="selected" value=""></option>
              </select>
            </td>
            <td>
              <input type="submit" name="" class="btn btn-block btn-flat btn-success btn-sm" value="Add" id="add_point" title="Click to add point">
            </td>
          </tr>
        </tbody>
      </table>
  </div>
</body>

<script>
  $(document).ready(function(){
    $("#selected_area").on('change', function() {
      var selected_area_val = $("#selected_area").val();
      var selected_area_txt = $("#selected_area option:selected").text();

      var req = {
        'description': selected_area_val,
        'number' : selected_area_txt
      };

      ReqStorage = [];
      ReqStorage.push(req);

      ///put additional requirements into local storage
      localStorage.setItem("ReqStorage", JSON.stringify(ReqStorage));

      location.reload();
    });

  });
</script>
</html>‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍‍