<?php
include 'db.php';
session_start();
if(isset($_GET["code"]))
{
$code=$_GET["code"];
$link=  mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
$result=  mysqli_query($link, "select * from doctor_user where code='$code'");
if(mysqli_affected_rows($link)>0)
{
$row=  mysqli_fetch_array($result);


echo "<h2>Doctor Details</h2>";
               echo "<table>";
                 echo   "<tr>";
                 echo       "<td><label class='patient_docinfo'>Doctor Code</label></td>";
                 echo       "<td><label class='patient_docdetails'>$row[3]</label></td>";
                 echo   "</tr>";
                 echo   "<tr>";
                 echo       "<td><label class='patient_docinfo'>Doctor Name</label></td>";
                 echo       "<td><label class='patient_docdetails'>$row[0] $row[1]</label></td>";
                  echo  "</tr>";
                  echo  "<tr>";
                  echo      "<td><label class='patient_docinfo'>Address</label></td>";
                 echo       "<td><label class='patient_docdetails'>$row[6]</label></td>";
                 echo   "</tr>";
                    echo   "<tr>";
                 echo       "<td><label class='patient_docinfo'>Patient First Name</label></td>";
                 echo       "<td><input type='text' class='inputs' name='pfname' placeholder='Patient First Name' required='true'></td>";
                 echo   "</tr>";
                 echo   "<tr>";
                 echo       "<td><label class='patient_docinfo'>Patient Last Name</label></td>";
                 echo       "<td><input type='text' class='inputs' name='plname' placeholder='Patient Last Name' required='true'></td>";
                 echo   "</tr>";
                 echo   "<tr>";
                 echo       "<td><label class='patient_docinfo'>Patient Age</label></td>";
                 echo       "<td><input type='number' class='inputs' name='age' placeholder='Patient Age' required='true'></td>";
                 echo   "</tr>";
                 echo   "<tr>";
                 echo       "<td><label class='patient_docinfo'>Patient Illness</label></td>";
                 echo       "<td><input type='text' class='inputs' name='illness' placeholder='Patient Illness' required='true'></td>";
                 echo   "</tr>";
              echo  "</table>";
              echo  "<input type='submit' value='Appointment' name='appointment' class='register_btn'>";
              
}
      else
      {
          echo "<p>YOU HAVE NOT ENTERED ANY CODE\nOR THE CODE IS INCORRECT</p>";
      }
      mysqli_close($link);
}

?>