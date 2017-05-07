<?php
require "PHPMailer-master/class.phpmailer.php";
session_start();
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();
       // destroy session data in storage
}
if(isset($_POST['em'])){
    $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPDebug = 2;
                $mail->From = "traffic.updater.bd@gmail.com";
                $mail->FromName = "Traffic24";
                $mail->SMTPAuth = true; 
                $mail->SMTPSecure = 'ssl'; 
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465; 
                $mail->IsHTML(true);
                $mail->Username = "traffic.updater.bd";
                $mail->Password = "webproject2543";
                $mail->AddAddress("cleopatra.sopto7@gmail.com", 'Melody');
                $mail->Subject = "Suggestion from a user";
                $mail->Body    = $_POST['msg'];
                $mail->IsHTML(true);
                $text = 'Text version of email';
                $html = '<html><body>HTML version of email</body></html>';
                $mail->Header  = 'MIME-Version: 1.0' . "\r\n";
                $mail->Header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
                $mail->Header .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
                $mail->Header .= 'From: Birthday Reminder <cleopatra.sopto7@gmail.com>' . "\r\n";
                $mail->Header .= 'Cc: birthdayarchive@example.com' . "\r\n";
                $mail->Header .= 'Bcc: birthdaycheck@example.com' . "\r\n";
                if ($mail->send())
                //if (mail($subject,$message, $headers))
                {
                    $_SESSION["reviewed"] = 1;
                    header("Location: logged_in.php");
                } 
}
?>
<html>
    <head>
        
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/new.css">
        <link rel="stylesheet" href="../css/w3.css">
        <script type="text/javascript" src="../js/modernizr.custom.86080.js"></script>
        <title>User Account</title>
        
    </head>
    <body>
        <style>
        textarea {
    width: 30%;
    margin: 4px 8px;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
}
         body{
                /*background-size: contain;*/
                background: url("../img/final.jpg");
            }
            h1,h2,h3,h4{
                color:  white;
            }
            h5{
                font-family: verdana;
                font-size: 15px;
                color: black;
            }
            h2{
                font-size: 40px;
            }
        </style>
        
        
        <?php if(isset($_SESSION['use'])){
            echo "<center><h2><b>Welcome ".$_SESSION['use']."!</b></h2></center>";
            if($_SESSION['type'] == 'g'){
                echo "<br><a href=\"new_a.php\" class=\"button\">update your location</a>";
            }
            else
                echo "<br><a href=\"getloc.php\" class=\"button\">update traffic</a>";
            echo "<br><a href=\"home.php\" class=\"button\">Go to homepage</a>
            <br><a href=\"logout.php\" class=\"button\">Log out</a>";
            if(isset($_SESSION["reviewed"])){
                    echo "Thank you for your suggestions.";
                }
                else{
            echo "<br><h3>&ensp;Any suggestions?</h3>
            <form action=\"logged_in.php\"method = \"POST\">
            <textarea type=\"text\" name=\"msg\" required placeholder =\"Suggestions?\"></textarea>
            <br><input type=\"submit\" name=\"em\" value=\"SUBMIT\">
            </form>";
        }
        
    }
        else
            echo "<h2>You are not supposed to be here!</h2>";
        ?>


        
        
    </body>
</html>