<?php
include('../html/common.html');
require "PHPMailer-master/class.phpmailer.php";
session_start();
$_SESSION['LAST_ACTIVITY'] = time();
        //require ("config.php");
$DbConn = mysqli_connect("localhost", "root","", "amateur");
if(isset($_GET['name']) && isset($_GET['code']))
            {
                $name=$_GET['name'];
                $code=$_GET['code'];
                //print($name);
                /*echo $name;
                echo $code;*/
                /*mysql_connect('localhost','root','');
                mysql_select_db('sample');*/
                $select = mysqli_query($DbConn, "select * from verification where name ='" . $name . "' and  code = '" . $code . "'");
                /*$select = mysqli_query($DbConn,"select name,email,pass,type from verification where name ='" . $name . "' and code ='".$code."'");*/
    
                $i = mysqli_num_rows($select);
                print("\n");
                print($i);
                while($i > 0) {
                    $row = mysqli_fetch_row($select);
                    $i--;
                    $name2 = $row[0]; 
                        $email = $row[1];
                        $password = $row[2];
                        $type = $row[3];
                        $insert_user=mysqli_query($DbConn,"insert into users values('$name2','$email','$password','$type')");
                        $delete=mysqli_query($DbConn,"delete from verification where name='".$name."' and code='".$code."'");
                        $_SESSION['use'] = $name2;
                        $_SESSION['type'] = $type;
                        header("Location:logged_in.php");
                }
                
                
            }

         if(isset($_POST['btn']) || isset($_POST['btn1']))
        {
            $name = mysqli_real_escape_string($DbConn,$_POST['fname']);
            $email = mysqli_real_escape_string($DbConn,$_POST['fname2']);
            $pass = mysqli_real_escape_string($DbConn,$_POST['fname1']);
            $pass = sha1($pass);
            $name = strip_tags($name);
            $pass = strip_tags($pass);
            $email = strip_tags($email);
            $code=substr(md5(mt_rand()),0,15);
            $dup = "select name from users where email = '" . $email . "'";
            $result = mysqli_query($DbConn, $dup);
            if(mysqli_num_rows($result))
            {
                print("<h2>You already have an account!</h2>");
                //print("<br><br><a href=\"showall.php\">Show all entry</a>
                print("<h2>Try a different Email!</h2>");
               // print("<br><br><a href=\"index.php\" class=\"button\">Go to homepage</a>");
            }
            else{

                if(isset($_POST['btn'])){
                    $insert=mysqli_query($DbConn,"insert into verification values('$name','$email','$pass','g','$code')");
                }
                else if(isset($_POST['btn1'])){
                    $insert=mysqli_query($DbConn,"insert into verification values('$name','$email','$pass','a','$code')");
                }
                /*print($code+"****************");*/
                /*$message = "Your Activation Code is ".$code."";
                $to=$email;
                $subject="Activation Code For Traffic Updater.";
                $from = 'cleopatra.sopto7@gmail.com';
                $body='Your Activation Code is '.$code.' Please Click On This link <a href="verification.php">signup.php?name='.$name.'&code='.$code.'</a>to activate your account.';
                //$headers = "From:".$from;
                $headers  = 'MIME-Version: 1.0' . "\r\n";

                ini_set( 'sendmail_from', "cleopatra.sopto7@gmail.com" ); 
                ini_set( 'SMTP', 'localhost' ); 
                ini_set( 'smtp_port', 25 );
                mail($to,$subject,$body,$headers);
    
                print("An Activation Code Is Sent To You. Check Your Email");*/
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
                $mail->AddAddress($email, 'Melody');
                $mail->Subject = "Verify your account";
                $mail->Body    = 'Your Activation Code is '.$code.' Please Click <a href="localhost/Web/php/signup.php?name='.$name.'&code='.$code.'">Here </a>to activate your account.';
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
                /*$file = 'index.php';*/
                
                if ($mail->send())
                //if (mail($subject,$message, $headers))
                {
                    echo "Successfully sent";
                    header("Location:../index.html");
                } 
                else {
                    echo "Mailed Error: " . $mail->ErrorInfo;
                }
            }

        }


            
            ?>




                <!-- if(isset($_POST['btn']))
                    $query = "Insert into users(name,email,pass,type) values('$name','$email','$pass','g')";
                else $query = "Insert into users(name,email,pass,type) values('$name','$email','$pass','d')";
                $ret = mysqli_query($DbConn,$query);
                if($ret){
                    print("<h2>Successfully Registered!</h2>");
                    $_SESSION["use"] = $name;
                    print("<br><br><a href=\"logged_in.php\" class=\"button\">Your account</a>");
                }
            }
            print("<br><br><a href=\"../index.html\" class=\"button\">Go to homepage</a>");
          }
          ?> -->
