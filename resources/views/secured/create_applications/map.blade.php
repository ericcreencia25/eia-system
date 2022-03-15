<script>
  $(document).ready(function(){
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
    }
    else 
    {
        alert('It seems like Geolocation, which is required for this page, is not enabled in your browser.');
    }

  });

  function modalPolyLine(Area)
  {

    var container = L.DomUtil.get('map');

    if(container != null){
      container._leaflet_id = null;
    } 

    // var arr = [[14.659, 121.036], [14.655, 121.035], [14.653, 121.043], [14.659, 121.044]];
    var arr = [];
    var areaType;

    $.ajax({
      url: "{{route('getGeoTable')}}",
        type: 'GET',
        success: function(response){
          $.each(response, function(index, value ) {
            if(value[0] == Area){
              areaType = value[1];
              arr.push([value[4], value[5]]);
            }
          });

          var centerPoint = getCenterPoint(arr);

          var map = L.map('map').setView(centerPoint, 16);
          L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 19,
            crossOrigin: true,
          }).addTo(map);

          var polygon = L.polygon(
            arr
            ).addTo(map).bindPopup("I am a polygon.");

          polygon.bindPopup("Area " + Area + ': ' + areaType).openPopup();

          var popup = L.popup();

          map.on("click", function(event) { 
            popup
                  .setLatLng(event.latlng)
                  .setContent("You clicked the map at " + event.latlng.toString())
                  .openOn(map);
          });

          setTimeout(function(){ map.invalidateSize()}, 400);
        }
      });
  }


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

  function successFunction(position) 
  {
      var lat = position.coords.latitude;
      var long = position.coords.longitude;

      var container = L.DomUtil.get('map');

      var map = L.map('map').setView([lat, long], 16);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 19,
        crossOrigin: true,
      }).addTo(map);

      var popup = L.popup();

      var marker = L.marker([lat, long]).addTo(map);
          marker.bindPopup("Your current location: " + lat + ', ' + long).openPopup();

          map.on("click", function(event) { 
            popup
                .setLatLng(event.latlng)
                .setContent("You clicked the map at " + event.latlng.toString())
                .openOn(map);
              });

          setTimeout(function(){ map.invalidateSize()}, 400);
  }

  function errorFunction(position) 
  {
      alert('Error while getting your location!');
  }
    
  </script>


<!-- </html> -->