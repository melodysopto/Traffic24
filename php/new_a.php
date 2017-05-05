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
  
  
	$DbConn = mysqli_connect("localhost", "root","", "amateur");
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
     
    <link rel="stylesheet" href="../css/for_map.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
  <style>
   input[type=submit]{
    background-color: cadetblue;
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 8px;
    cursor: pointer;
}
    #map {
        margin-left: 10px;
        margin-top: 10px;
        height: 75%;
        width: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

#floating-panel1 {
        position: absolute;
        top: 10px;
        left: -125px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 273px;
        padding-right: 273px
      }
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 15%;
        padding: 5px;
        position: absolute;
        top: 10px;
        z-index: 5;
      }
#user_space{
  position: relative;
  padding: 300px 10px 10px 300px;
  top: 0px;
  height: 200px;
  left: 10%;
  right: 1300;
  /*background-color: orange;*/
}
  </style>
	<div id="floating-panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <!--button onclick="changeRadius()">Change radius</button-->
      <!--button onclick="changeOpacity()">Change opacity</button-->
    </div>
    <!-- <div class="col-sm-8" style="background-color:lavender;"> --> 
    <div id="map" class="col-sm-5"></div>
    <?php
  /*if(isset($_SESSION["success"])){*/
    //print($_SESSION["success"]);
    if($_SESSION["success"] == 1){

      echo "<div class=\"col-sm-5\"><h3>your data has been accepted, thank you.</h3></div>";
      $_SESSION["success"] = 0;
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
    <div id="user_space" class="col-sm-8">
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
    </div>
    </div>
  </body>
</html>
