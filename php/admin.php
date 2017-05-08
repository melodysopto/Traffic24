<?php
session_start();
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();
       // destroy session data in storage
}
$DbConn = mysqli_connect("localhost", "traffic24", "traffic24", "traffic24");
//$DbConn = mysqli_connect("localhost", "root","", "traffic24");
if(isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['day']) && isset($_POST['hour'])){
		$lat = $_POST["latitude"];
		$long = $_POST["longitude"];
		$day = $_POST["day"];
		$hour = $_POST["hour"];
		$intensity = 50;
		$in = mysqli_query($DbConn, "insert into traffic_points values('$lat','$long','$intensity','$day','$hour')");
		echo $in;
		echo $lat;
		echo " ";
		echo $long;
		echo " ";
		echo $day;
		echo " ";
		echo $hour;
	}
?>
