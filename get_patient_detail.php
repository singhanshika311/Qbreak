<?php
session_start();
include "db.php";
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
    $pemail=$_GET['email'];
    mysqli_query($link, "delete from doctor_que where pemail='$pemail'");
    mysqli_query($link, "update patient_user set appoint='0' where email='$pemail'");
    $queue=mysqli_query($link, "select * from doctor_que where doc_code='$doc_detailr[3]'");
    if(mysqli_affected_rows($link)>0)
    {
        $queuer=  mysqli_fetch_array($queue);
        echo "<td><label >$queuer[1] $queuer[2]</label></td></tr><tr>";
        echo "<td><label style='font-weight:bold;'>Illness</label></td>";
        echo "<td><label>$queuer[3]</label></td></tr><tr>";
        echo "<td><label style='font-weight:bold;'>Age</label></td>";
        echo "<td><label>$queuer[4]</label></td></tr></table></fieldset>";
        echo "<input type='button' onclick=\"nextpatient('$queuer[5]')\" class='done_with_patient' value='Done With Patient' ></div>";
        echo "<div class='partition' ><h1>QUEUED PATIENT</h1>";
        echo "<table class='patient_queue'>";
        echo "<tr><tr><th>NAME</th><th>ILLNESS</th><th>Age</th></tr>";
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