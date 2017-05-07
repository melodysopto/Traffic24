var map, infoWindow;
var latitude, longitude;
      var map, heatmap;
      var linkEnabled = true;
	   var count = 0;
      var arr=[];
      var test = [];
      function initMap() {
        /*if(count > 0)
          return;*/
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 23.81, lng: 90.4125},
          zoom: 15
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
	  maxIntensity: 10,
	  radius: 20,		
          map: map
        });
      infoWindow = new google.maps.InfoWindow;

       // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            //linkEnabled = false;
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;
            latitude = latitude.toFixed(4);
            longitude = longitude.toFixed(4);
            var x = new Date();
            var day = x.getDay();
            var hour = x.getHours();
            alert(latitude+" "+longitude+" "+day+" "+hour);

            $.ajax({
        type:"POST",
        url:"../php/new.php",
        data:{"latitude": latitude, "longitude": longitude, "day": day, "hour": hour},
        success:function(msg){
          //alert(msg);
        }
    });
            console.log(position.coords.latitude+" "+position.coords.longitude);
            /*var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;*/
            //alert(latitude+" "+longitude);
         
            infoWindow.setPosition(pos);
            //infoWindow.setMarker(pos);
            infoWindow.setContent('Here you are!');
            infoWindow.open(map);
            map.setCenter(pos);
             }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

      function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
        var gradient = [
          'rgba(0, 255, 255, 0)',
          'rgba(0, 255, 255, 1)',
          'rgba(0, 191, 255, 1)',
          'rgba(0, 127, 255, 1)',
          'rgba(0, 63, 255, 1)',
          'rgba(0, 0, 255, 1)',
          'rgba(0, 0, 223, 1)',
          'rgba(0, 0, 191, 1)',
          'rgba(0, 0, 159, 1)',
          'rgba(0, 0, 127, 1)',
          'rgba(63, 0, 91, 1)',
          'rgba(127, 0, 63, 1)',
          'rgba(191, 0, 31, 1)',
          'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }


      // Heatmap data: 500 Points
      function getPoints() {
	//alert(obj[1][2]);
	
	var count = 0;
	var i, j, k, tmp;

	for (i in obj) {
	    if (obj.hasOwnProperty(i)) {
		count++;
	    }
      var dx = new Date();
      var day = dx.getDay();
      var hour = dx.getHours();
      if(day==obj[count-1][3] && hour==obj[count-1][4]) { 
  	    tmp = {location: new google.maps.LatLng(obj[count-1][0],obj[count-1][1]), weight: obj[count-1][2]};
        arr.push(tmp);
      }
	    //console.log(obj[count-1][2]);
	    
	}
	//console.log(arr);
      /*get_nearest();*/
        return arr; 
      }