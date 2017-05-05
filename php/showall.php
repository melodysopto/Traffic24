<html>
    <head>
        
        <meta charset="UTF-8">
        <link rel="stylesheet" href="new.css">
        <title>Database</title>
        
    </head>
    <body>
        <style>
            body{
                background: url("melo.jpg");
            }
            h1,h2,h3,h4{
                color:  black;
            }
            table, th, td {
                border: 1px solid black;
                text-align-last: center;
                
            }
            th,td{
                padding: 15px;
            }
            .button {
    background-color: sienna;
}
        </style>
    </body>
</html>
<?php

$DbConn = mysqli_connect("localhost","root", "", "amateur");
$get = mysqli_query($DbConn,"select name,pass from users");
//$count = mysqli_num_rows($get);
print("<center><table style=\"width:60%\"><caption><h2>DATABASE</h2></caption>
  <tr>
    <th>USERNAME</th>
    <th>PASSWORD</th> 
  </tr>");

while ($row = mysqli_fetch_array($get)) {
      print("<tr><td>".$row["name"]."</td><td>".$row["pass"]."</td></tr>");
  //print("&ensp;&ensp;<h3>".$row[0]."&ensp;---&ensp;".$row[1]."</h3>");
}
print("</table></center>");
print("<br><br><center><a href=\"index.php\" class=\"button\">Go to homepage</a><center>");

?>
