<!DOCTYPE html>
<?php
session_start();
$_SESSION['LAST_ACTIVITY'] = time();
?>
<?php

  if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
       {
           header("Location: ../index.html");  
       }
  
	$DbConn = mysqli_connect("localhost", "traffic24","traffic24", "traffic24");
  /*$DbConn = mysqli_connect("localhost", "root","", "traffic24");*/

  /*$up = "update Traffic_points set intensity=intensity/2 where day ='" . $day . "' and  hour = '" . $hour . "'";
  $ret_u = mysqli_query($DbConn,$up);*/

	$latt = mysqli_query($DbConn, "select * from Traffic_points");
	$arr = array();
	
	$i = mysqli_num_rows($latt);
	while($i > 0) {
		$row = mysqli_fetch_row($latt);
		$i--;
		array_push($arr, $row);
	}

	$var = json_encode($arr);

	//$var = json_encode($arr);
?>

<html>
  <head>
    <title>Traffic Intensity</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
     
    <link rel="stylesheet" href="../css/changed.css">
     <link rel="stylesheet" href="../css/new.css">
    <link rel="stylesheet" type="text/css" href="../css/demo.css">
        <link rel="stylesheet" type="text/css" href="../css/style1.css">
    <script type="text/javascript" src="../js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
  <style type="text/css">
    body { 
      background-size: contain;
      background: url("../img/5.jpg"); }
      #map { height: 400px;
      }
  </style>
  <div class="container">
  <div class="row">
      <div id="map-outer" class="col-md-12">
          <div id="address" class="col-md-3">
            <h2>Traffic24</h2>
            <address>
            <strong><?php echo "<h3>".$_SESSION['use']."</h3>"; ?></strong>
            <?php
              if($_SESSION['type'] == 'g')
                echo "<h4>(General user)</h4>";
            ?>
            </address>
            <br><br><a href="logged_in.php" class="button">Go to main menu</a>
            <br><br><a href="logout.php" class="button">Log out</a>
                <!-- orsoduro, 701-704<br>
                30123<br>
                Venezia<br>
                Italia<br>
                <abbr>P:</abbr> +39 041 240 5411 -->
           
          </div>
        <div id="map" class="col-md-5"></div>
        <div id="user_space">
    <div id="floating-panel1">
  <b>Traffic?</b>
  <form action = "new.php" method="POST"> 
    <select name="op">
      <option value="yes">YES</option>
      <option value="no">NO</option>
    </select>
   <!--  <button onclick="function()">UPDATE</button> -->
    <input type ="submit" name= "submit" value="UPDATE">
     </form> 
     <div id="floating-panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <!--button onclick="changeRadius()">Change radius</button-->
      <!--button onclick="changeOpacity()">Change opacity</button-->
    </div> 
    </div>
    </div>

      </div><!-- /map-outer -->

  </div>






    <!-- <div class="col-sm-8" style="background-color:lavender;"> --> 
    <!-- <div id="map"></div>
      <h3>Profile details here.</h3> -->
    <?php
  /*if(isset($_SESSION["success"])){*/
    //print($_SESSION["success"]);
    if($_SESSION["success"] == 1){

      echo "<div><h3>your data has been accepted, thank you.</h3></div>";
      $_SESSION["success"] = 0;
    }
    else{
      echo "<div></div>";
    }
    /*if($_SESSION["success"] == 0){
      echo "<div class=\"col-sm-5\"><h3>your data has been inserted, thank you.</h3></div>";
      //$_SESSION["success"] = 0;
    }*/?>
    <!-- <p id="location">Location:</p> -->
    <script>
    spge = '<?php echo $var;?>';
	var obj = JSON.parse(spge);</script>
  <!-- <script src="../js/jquery-3.2.1.min.js"></script> -->
  
  
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
  <script src = "../js/utility_a.js"></script>
   <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHlNJ7-4bqs-T-M2qaVBBAjHw_ELKaRac&libraries=visualization&callback=initMap">
    </script>
 <!-- <script src="../js/update.js"></script>  -->
    
  </body>
</html>
