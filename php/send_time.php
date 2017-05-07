<?php
session_start();
$DbConn = mysqli_connect("localhost", "root","", "amateur");
if(isset($_POST['day']) && isset($_POST['hour']){
	$_SESSION["day"] = $_POST['day'];
	$_SESSION["hour"] = $_POST['hour'];
	$day = $_SESSION["day"];
	$hour = $_SESSION["hour"];
	echo $day;
	$q = "select * from Traffic_points where day = '".$day."' and hour = '".$hour."'";

}