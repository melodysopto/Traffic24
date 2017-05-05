<?php session_start();
$_SESSION['LAST_ACTIVITY'] = time();?>
<html>
    <head>

        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/new.css">
        <title>Login Page</title>
     
    <!-- for mobile view -->
    <meta content='width=device-width, initial-scale=1' name='viewport'/>
    </head>
    <body>
        <style>
            body{
                background: url("../img/melo.jpg");
            }
            h1,h2,h3,h4{
                color:  black;
            }
        </style>

        <?php
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
        //require ("config.php");
        $DbConn = mysqli_connect("localhost", "root", "", "amateur");
        if (isset($_POST['btn'])) {
            $name = mysqli_real_escape_string($DbConn, $_POST['fname']);
            $pass = mysqli_real_escape_string($DbConn, $_POST['fname1']);
            $pass = sha1($pass);
            $name = strip_tags($name);
            $pass = strip_tags($pass);
            $dup = "select name from users where name = '" . $name . "'";
            $result = mysqli_query($DbConn, $dup);
            if (mysqli_num_rows($result)) {
                $dup1 = mysqli_query($DbConn, "select name from users where name ='" . $name . "' and  pass = '" . $pass . "'");
                if (mysqli_num_rows($dup1) == 1) {
                    $_SESSION['use']=$name;
                    header("Location:logged_in.php"); 
                    /*print("<h2>Welcome " . "$name" . "!</h2>");
                    
                     print("<br><br><a href=\"new_a.php\" class=\"button\">get your location</a>");*/
//                    
                } else {
                    print("<h2>Wrong password</h2>");
                    //header("Location:login.php");
                    // print("<br><br><a href=\"index.php\" class=\"button\">Go to homepage</a>");
                }
            } else {
                //print($name." ".$pass);
                print("<br><br>&ensp;<h3>Please <a href=\"index.html\"> Register </a>first!</h3>");
            }
        }
        print("<br><br><a href=\"home.php\" class=\"button\">Go to homepage</a>");
        print("<br><br><a href=\"logout.php\" class=\"button\">Log out</a>");
        ?>
        
    </body>
</html>
