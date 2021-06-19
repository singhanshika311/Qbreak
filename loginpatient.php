<?php
include "db.php";
session_start();
if(isset($_POST["register_btn"]))
{
    $email=$_POST["email"];
    $password=md5($_POST["password"]);
    $link=mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
    $result=mysqli_query($link, "select * from patient_user where email='$email' AND password='$password'");
    if(mysqli_affected_rows($link)>0)
    {
        
        $row=  mysqli_fetch_array($result);
        setcookie("trio",$email,time()+(86400*7),"/");
        setcookie("trio_name","$row[0] $row[1]",time()+(86400*7),"/");
        setcookie("appoint","$row[7]",time()+(86400*7),"/");
        $_SESSION[$email]=$email;
        mysqli_close($link);
        header("location:patienthome.php");
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
                <form method="post">
                <h1>Patient Login</h1> 
                <table>
                    <tr>
                        <td><label class="reg_label">Email</label></td>
                        <td><input type="text" class="inputs" name="email" placeholder="Email" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Password</label></td>
                        <td><input type="password" class="inputs" name="password" placeholder="Password" required="true"></td>
                    </tr>
                    
                    </tr>
                    
                </table>
                <input type="submit" name="register_btn" class="register_btn">
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="trio.js?v=<?php echo time();?>">
        
    </script>
</html>