<html>
    <head>
        
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/new.css">
        <title>Login Page</title>
        
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

          <h1>Log in</h1>
        <form action = "login.php" method="POST">
       <input type="text" name="fname" required placeholder="Username">
        <br><input type="password" name="fname1" required placeholder="Password">
            <br> <br> 
            <input type="submit" name="btn" value="Login">
        </form>
       
        <br>                     
<!--        <a href="showall.php" class="button">Go to database</a>-      ->
        <!--<br>
        <br>
        &ensp;Already have an account?
        <br>
        <a href="login.php" class="button">LOG IN</a>-->
    </body>
</html>
