<?php
include 'db.php';
session_start();
if(!isset($_SESSION[$_COOKIE['trio']]))
{
    if(isset($_COOKIE['trio']))
    {
        setcookie("trio","",time()-3600,'/');
        
    }
    header("location:index.php");
}
$myemail=$_SESSION[$_COOKIE['trio']];
$link=  mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
$mydetail=  mysqli_query($link, "select * from patient_user where email='$myemail'");
$myresult=  mysqli_fetch_array($mydetail);
$_COOKIE["appoint"]=$myresult[7];
mysqli_close($link);
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
                <a href="logout.php"><label>Logout</label></a>
            </div>
            <h2 class="welcome">Welcome <?php $name=$_COOKIE['trio_name'] ;echo "$name" ; ?></h2>
            
                <?php
                $message="";
                if(isset($_POST["appointment"]))
                {
                    $code=$_POST["doctorcode"];
                    $pfname=$_POST["pfname"];
                    $plname=$_POST["plname"];
                    $age=$_POST["age"];
                    $illness=$_POST["illness"];
                    $link=mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
                    $result=  mysqli_query($link, "select * from doctor_que where doc_code='$code' order by time DESC");
                    if(mysqli_affected_rows($link)>0)
                    {
                        $t=  mysqli_fetch_array($result);
                        $time=strtotime($t[6]);
                    }
                    else
                    {
                        $time=strtotime("10:00am");
                    }
                    if($time<strtotime("today 08:00pm") && time()<strtotime("today 08:00pm"))
                    {
                        $t2=$time+(15*60);
                        if($t2<time())
                        {
                            $t2=time();
                            $t2=$time+(15*60);
                        }
                        $t2=date("Y-m-d H:i:s",$t2);
                        $pemail=$_SESSION[$_COOKIE["trio"]];

                        $result1=  mysqli_query($link, "insert into `doctor_que` (`doc_code`, `pfname`, `plname`, `illness`, `age`, `pemail`, `time`) values ('$code','$pfname','$plname','$illness','$age','$pemail','$t2')");
                        $result2=  mysqli_query($link, "update patient_user set appoint='$code' where email='$pemail'");
                        setcookie("appoint",$code,time()+(86400*7),"/");
                        header("location:patienthome.php");
                    }
                    else
                    {
                        $message="<p>DOCTOR IS FULL OF APPOINTMENT TRY TOMMAROW</p>";
                    }
                    mysqli_close($link);
                }
                if($_COOKIE["appoint"]=="0")
                {
                    echo "<form method='post'><div class='register'>";
                    echo "<h1>Enter Code For Appointment</h1>";
                    echo "<table><tr><td><label class='reg_label'>Doctor Code</label></td>";
                    echo "<td><input type='text' class='inputs' id='doctorcode' name='doctorcode' placeholder='Enter Code' required='true'></td></tr>";
                    
                    echo "</table><input type='button' name='register_btn' value='Get Detail' onclick='doctor_details()' class='register_btn'>";
                
                    echo "</div><hr><div class='register' id='doctor_details'>$message</div></form>";
                }
             ?>
            <hr>
            <div class="register">
                <?php
                if($_COOKIE["appoint"]!=="0")
                {
                    $pemail=$_SESSION[$_COOKIE["trio"]];
                    $link=  mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
                    $detail1=  mysqli_query($link, "select * from doctor_que where pemail='$pemail'");
                    $rdetail1=  mysqli_fetch_array($detail1);
                    $detail2=  mysqli_query($link, "select * from doctor_user where code='$rdetail1[0]'");
                    $rdetail2=  mysqli_fetch_array($detail2);
                    $t3=date("H:i",strtotime($rdetail1[6]));
                        echo "<h2>Your Appointment</h2><table><tr><td><label class='patient_docinfo'>Doctor Code</label></td>";
                        echo "<td><label class='patient_docdetails'>$rdetail1[0]</label></td></tr><tr>";
                        echo "<td><label class='patient_docinfo'>Doctor Name</label></td>";
                        echo "<td><label class='patient_docdetails'>$rdetail2[0] $rdetail2[1]</label></td></tr><tr>";
                        echo "<td><label class='patient_docinfo'>Address</label></td>";
                        echo "<td><label class='patient_docdetails'>$rdetail2[6]</label></td></tr><tr>";
                        echo "<td><label class='patient_docinfo'>Time Alloted</label></td>";
                        echo "<td><label class='patient_docdetails'>$t3</label></td></tr>";
                        echo "</table>";
                }
                ?>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="trio.js?v=<?php echo time();?>">
        
    </script>
</html>