<?php
session_start();
include "db.php";
if(isset($_POST["register_btn"]))
{
    $fname=strtoupper($_POST["fname"]);
    $lname=strtoupper($_POST["lname"]);
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $dob=$_POST["dob"];
    $gender=$_POST["gender"];
    $address=$_POST["address"];
    $password=md5($_POST["password"]);
    $role=$_POST["role"];
    $link=mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
    mysqli_query($link, "insert into $role (`fname`, `lname`, `email`, `password`, `phone`, `address`, `dob`, `gender`) values ('$fname','$lname','$email','$password','$phone','$address','$dob','$gender')");
    if(mysqli_affected_rows($link)>0)
    {
        setcookie("trio",$email,time()+(86400*7),"/");
        $_SESSION["$email"]=$email;
        if($role=="doctor_user")
        {
            header("location:doctorhome.php");
            mysqli_close($link);
        }
        else
        {
            header("location:patienthome.php");
            mysqli_close($link);
        }
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
                <h1>Register</h1> 
                <form method="post">
                <table>
                    <tr>
                        <td><label class="reg_label">First Name</label></td>
                        <td><input type="text" class="inputs" name="fname" placeholder="Name" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Last Name</label></td>
                        <td><input type="text" class="inputs" name="lname" placeholder="Name" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Email</label></td>
                        <td><input type="text" class="inputs" name="email" placeholder="Email" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Phone No.</label></td>
                        <td><input type="tel" maxlength="10" class="inputs" name="phone" placeholder="Phone" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Date Of Birth</label></td>
                        <td><input type="date" class="inputs" name="dob" placeholder="Date Of Birth" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Gender</label></td>
                        <td>
                            <input type="radio" name="gender" value="M"><label>Male  </label>
                            <input type="radio" name="gender" value="F"><label>Female  </label>
                            <input type="radio" name="gender" value="O"><label>Other    </label>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Address</label></td>
                        <td><textarea placeholder="Address" name="address" rows="3" cols="35"></textarea></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Password</label></td>
                        <td><input type="password" class="inputs" id="password" name="password" placeholder="Password" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Confirm Password</label></td>
                        <td><input type="password" class="inputs" name="cnfpassword" id="cnfpassword" onblur="check_password()" placeholder="Confirm Password" required="true"></td>
                    </tr>
                    <tr>
                        <td><label class="reg_label">Doctor/Patient</label></td>
                        <td>
                            <input type="radio" name="role" value="doctor_user"><label>Doctor      </label>
                            <input type="radio" name="role" value="patient_user"><label>Patient       </label>
                        </td>
                    </tr>
                    
                </table>
                    
                    <input type="submit"  id="register" name="register_btn" class="register_btn">
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="trio.js?v=<?php echo time();?>">
        
    </script>
</html>