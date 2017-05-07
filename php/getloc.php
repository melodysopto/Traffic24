<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
    <title>Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/new.css">

         <link rel="stylesheet" type="text/css" href="../css/demo.css">
        <link rel="stylesheet" type="text/css" href="../css/style1.css">
        <link rel="stylesheet" href="../css/w3.css">
        <link rel="stylesheet" href="../css/changed.css">
        

    <script type="text/javascript" src="../js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        /*height: 100%;*/
        height: 100%;
        width: 70%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      body { 
      	background-size: contain;

      	background-image : url("../img/6.jpg"); }
    </style>
  </head>
  <body>
  <div class="container">
  <div class="row">
      <div id="map-outer" class="col-md-12">
          <div id="address" class="col-md-3">
            <h2><black>Traffic24</black></h2>
            <address>
            <strong><h3><?php echo $_SESSION['use']?></h3></strong>
            <?php
              if($_SESSION['type'] == 'a')
                echo "<h4>(Admin account)</h4>";
            ?>
            <h4>Click on the places you are aware of having a traffic load.</h4>
            </address>
            <br><a href="logged_in.php" class="button">Go to main menu</a>
            <br><a href="logout.php" class="button">Log out</a>
                <!-- orsoduro, 701-704<br>
                30123<br>
                Venezia<br>
                Italia<br>
                <abbr>P:</abbr> +39 041 240 5411 -->
           
          </div>
        <div id="map" class="col-md-5"></div>
        <!-- <div id="user_space">
    <div id="floating-panel1">
  <b>Traffic?</b>
  <form action = "new.php" method="POST"> 
    <select name="op">
      <option value="yes">YES</option>
      <option value="no">NO</option>
    </select>
   <!--  <button onclick="function()">UPDATE</button> -->
    <!--<input type ="submit" name= "submit" value="UPDATE">
     </form> 
     <div id="floating-panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <!--button onclick="changeRadius()">Change radius</button-->
      <!--button onclick="changeOpacity()">Change opacity</button-->
    <!--</div> 
    </div>
    </div> -->
</div>
      </div><!-- /map-outer -->

  </div>

    <!-- <div id="map"></div> -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
    <script>

        function initMap() {
		  var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 14,
			center: {lat: 23.81, lng: 90.4125}
		  });
		  var d = new Date();
		  hour = d.getHours();
		  day = d.getDay();

		  map.addListener('click', function(e) {
			placeMarkerAndPanTo(e.latLng, map);
			$.ajax({
				type:"POST",
				url:"admin.php",
				data:{"latitude": e.latLng.lat().toFixed(4), "longitude": e.latLng.lng().toFixed(4),
					"day": day, "hour": hour},
				success:function(msg){
				  alert(msg);
				}
			  });
		  });

		  
		}

		function placeMarkerAndPanTo(latLng, map) {
			var image = '../img/bus.png';
		  	var marker = new google.maps.Marker({
			position: latLng,
			map: map,
			icon: image
		  });
		}

      
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHlNJ7-4bqs-T-M2qaVBBAjHw_ELKaRac&callback=initMap">
    </script>
  </body>
</html>
