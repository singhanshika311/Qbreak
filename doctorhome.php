<?php
include 'db.php';
session_start();
if(!isset($_SESSION[$_COOKIE['triod']]))
{
    if(isset($_COOKIE['triod']))
    {
        setcookie("triod","",time()-3600,'/');
        
    }
    header("location:index.php");
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
                <a href="logout1.php"><label>Logout</label></a>
            </div>
            <div class='doctor_main' id="doctor_main">
                <?php
                    $name=$_COOKIE['triod_name'];
                    $email=$_SESSION[$_COOKIE['triod']];
                    $link=  mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
                    $doc_detail=  mysqli_query($link, "select * from doctor_user where email='$email'");
                    $doc_detailr=  mysqli_fetch_array($doc_detail);
                    
                    echo "<div class='partition'><h1>$name</h1>";
                    echo "<h3>$doc_detailr[2]/$doc_detailr[3]</h3><fieldset style='width:70%; margin-top: 100px; border-radius: 10px;'>";
                    echo "<legend style='font-size:25px; font-weight: bold;'>Current Patient</legend>";
                    echo "<table class='patient_detail_doctor' style='width:100%;'><tr>";
                    echo "<td><label style='font-weight:bold;'>Name</label></td>";
                    $queue=  mysqli_query($link, "select * from doctor_que where doc_code='$doc_detailr[3]'");
                    if(mysqli_affected_rows($link)>0)
                    {
                        $queuer=  mysqli_fetch_array($queue);
                        $mail=$queuer[5];
                        echo "<td><label >$queuer[1] $queuer[2]</label></td></tr><tr>";
                        echo "<td><label style='font-weight:bold;'>Illness</label></td>";
                        echo "<td><label>$queuer[3]</label></td></tr><tr>";
                        echo "<td><label style='font-weight:bold;'>Age</label></td>";
                        echo "<td><label>$queuer[4]</label></td></tr></table></fieldset>";
                        echo "<input type='button' id='click' onclick=\"nextpatient('$queuer[5]')\" class='done_with_patient' value='Done With Patient' ></div>";
                        echo "<div class='partition'><h1>QUEUED PATIENT</h1>";
                        echo "<table class='patient_queue'>";
                        echo "<tr><th>NAME</th><th>ILLNESS</th><th>Age</th></tr>";
                        $count=0;
                        while($queuer=mysqli_fetch_array($queue) && $count<4)
                        {
                        echo "<tr><td>$queuer[1] $queuer[2]</td><td>$queuer[3]</td><td>$queuer[4]</td></tr>";
                        $count++;
                        }
                        while($count<4)
                        {
                            echo "<tr><td></td><td></td><td></td></tr>";
                            $count++;
                        }
                        echo "</table></div>";
                    }
                    else
                    {
                        echo "<td><label ></label></td></tr><tr>";
                        echo "<td><label style='font-weight:bold;'>Illness</label></td>";
                        echo "<td><label></label></td></tr><tr>";
                        echo "<td><label style='font-weight:bold;'>Age</label></td>";
                        echo "<td><label></label></td></tr></table></fieldset>";
                        echo "<input type='button' class='done_with_patient'  value='Done With Patient' ></div>";
                        echo "<div class='partition'><h1>QUEUED PATIENT</h1>";
                        echo "<table class='patient_queue'>";
                        echo "<tr><tr><th>NAME</th><th>ILLNESS</th><th>Age</th></tr>";
                        echo "<tr><td></td><td></td><td></td></tr>";
                        echo "<tr><td></td><td></td><td></td></tr>";
                        echo "<tr><td></td><td></td><td></td></tr>";
                        echo "<tr><td></td><td></td><td></td></tr></table></div>";
                    }
                    mysqli_close($link);
                ?>
        </div>
    </body>
    <script type="text/javascript" src="trio.js?v=<?php echo time();?>">
        
    </script>
</html>