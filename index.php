<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>QBREAK</title>
        <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class="container" id="container">
            <div class="header">
                <a href="register.php"><label>Register</label></a>
            </div>
            <div class="main">
                <h2>Login</h2> 
                <div class="patient">
                    <a href="loginpatient.php"><label>As Patient</label></a>
                </div>
                <div class="doctor">
                    <a href="logindoctor.php"><label>As Doctor</label></a>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="trio.js?v=<?php echo time();?>">
        
    </script>
</html>
