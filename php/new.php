<?php
include ('../html/common.html');
/*$DbConn = mysqli_connect("localhost", "traffic24","traffic24", "traffic24");*/
$DbConn = mysqli_connect("localhost", "root","", "traffic24");
session_start();
$_SESSION['LAST_ACTIVITY'] = time();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();
    header("Location: ../new_a.php");   // destroy session data in storage
}
//$DbConn = mysqli_connect("localhost", "root","", "amateur");
 if(isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['day']) && isset($_POST['hour'])){
    //Send request and receive json data by latitude and longitude
    //Print address 
    //print("Hello");
   	$_SESSION["latitude"] = $_POST["latitude"];
    $_SESSION["longitude"] = $_POST["longitude"];
    $_SESSION["day"] = $_POST["day"];
    $_SESSION["hour"] = $_POST["hour"];
    $_SESSION["success"] = 0;
    /*$lat = $_POST["latitude"];
    $hello = $_POST["latitude"];
    $long = $_POST["longitude"];
*/    echo "data paise";
    
}
if(isset($_POST['op']))
{
 	$lat = mysqli_real_escape_string($DbConn, $_SESSION['latitude']);
    $long = mysqli_real_escape_string($DbConn, $_SESSION['longitude']);
    $d = mysqli_real_escape_string($DbConn, $_SESSION['day']);
    $h = mysqli_real_escape_string($DbConn, $_SESSION['hour']);
            //$pass = sha1($pass);
    $lat = strip_tags($lat);
    $long = strip_tags($long);
    $d = strip_tags($d);
    $h = strip_tags($h);
  	if($_POST['op'] == "yes" && isset($_SESSION["latitude"]) && isset($_SESSION["longitude"])){
  		$up = "update traffic_points set intensity=intensity+1 where latitude ='" . $lat . "' and  longitude = '" . $long . "'";
        $retu = mysqli_query($DbConn,$up);
  		$add = "insert into traffic_points(latitude,longitude,intensity,day,hour) values('$lat','$long','1','$d','$h')";
  		$reti = mysqli_query($DbConn,$add);
  		$_SESSION["success"] = 1;
        header("Location: new_a.php");
        
  		//print($_SESSION["latitude"]);
  	}
  	else{
  		$up = "update traffic_points set intensity=intensity-1 where latitude ='" . $lat . "' and  longitude = '" . $long . "' and intensity>0";
        $reti = mysqli_query($DbConn,$up);
       	$add = "insert into traffic_points(latitude,longitude,intensity) values('$lat','$long','0','$d','$h')";
        $retu = mysqli_query($DbConn,$add);
        $_SESSION["success"] = 1;
        header("Location: new_a.php");
    }

}
?>


