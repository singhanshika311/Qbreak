<?php
include "db.php";
session_start();
if(isset($_POST["register_btn"]))
{
    $email=$_POST["email"];
    $doctorcode=$_POST["doctorcode"];
    $password=md5($_POST["password"]);
    $link=mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
    $result=mysqli_query($link, "select * from doctor_user where email='$email' AND password='$password' AND code='$doctorcode'");
    if(mysqli_affected_rows($link)>0)
    {
        
        $row=  mysqli_fetch_array($result);
        setcookie("triod",$email,time()+(86400*7),"/");
        setcookie("triod_name","$row[0] $row[1]",time()+(86400*7),"/");
        $_SESSION[$email]=$email;
        header("location:doctorhome.php");
        mysqli_close($link);
    }
    mysqli_close($link);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>QBREAK</title>
        <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class="container" id="container">
            <div class="header">
                <a href="index.php"><label>Login</label></a>
            </div>
            <div class="register">
                <h1>Doctor Login</h1>
                <form method="post">
                <table>
                    <tr>
                        <td><label class="reg_label">Email</label></td>
                        <td><input type="text" class="inputs" name="email" placeholder="Email" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Doctor Code</label></td>
                        <td><input type="text" class="inputs" name="doctorcode" placeholder="Doctor Code" required="true"></td>
                    </tr>
                    
                    <tr>
                        <td><label class="reg_label">Password</label></td>
                        <td><input type="password" class="inputs" name="password" placeholder="Password" required="true"></td>
                    </tr>
                    
                    
                </table>
                <input type="submit" name="register_btn" class="register_btn">
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="trio.js?v=<?php echo time();?>">
        
    </script>
</html><!DOCTYPE html>
