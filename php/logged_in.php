<?php
session_start();
$_SESSION['LAST_ACTIVITY'] = time();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();
       // destroy session data in storage
}
?>
<html>
    <head>
        
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/new.css">
        <title>Sign up or Log in</title>
        
    </head>
    <body>
        <style>
            #cont{
                position:   initial;
                background-color: wheat;
                top: 0px;
                bottom: 25px;
                left: 0px;
                right: 1366px;
            }
            body{
                background: url("../img/melo.jpg");
            }
            h1,h2,h3,h4{
                color:  black;
            }
            h5{
                font-family: verdana;
                font-size: 15px;
                color: black;
            }
        </style>

         <h2>Welcome <?php echo $_SESSION['use']; ?>!</h2>           
         <br><br><a href="new_a.php" class="button">get your location</a>
         <br><br><a href="home.php" class="button">Go to homepage</a>
         <br><br><a href="logout.php" class="button">Log out</a>
    </body>
</html>