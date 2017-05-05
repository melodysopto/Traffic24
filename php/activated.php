<?php
include('../html/common.html');
session_start();
$_SESSION['LAST_ACTIVITY'] = time();

$DbConn = mysqli_connect("localhost", "root","", "amateur");

            if(isset($_GET['name']) && isset($_GET['code']))
            {
                $name=$_GET['name'];
                $code=$_GET['code'];
                print($name);
                echo $name;
                echo $code;
                /*mysql_connect('localhost','root','');
                mysql_select_db('sample');*/
                $select=mysqli_query($DbConn,"select name,email,password,type from verification where name='$name' and code='$code'");
                if(mysql_num_rows($select)==1)
                {
                    while($row=mysql_fetch_array($select))
                    {
                        $name = $row['name'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $type = $row['type'];
                    }
                    $insert_user=mysqli_query($DbConn,"insert into users values('$name','$email','$password','type')");
                    $delete=mysql_query("delete from verification where name='$name' and code='$code'");
                }
            }