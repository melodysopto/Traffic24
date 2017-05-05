<?php
$dbUser = "root";
$dbPass = "";
$dbDatabase = "amateur";
$dbHost = "localhost";

$DbConn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbDatabase);

if(!$DbConn)
{
    die("more toh gechi shei kobei");
}
 else {
     print("YAY!");
     }

?>

