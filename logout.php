<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <?php
            session_start();
session_destroy();
setcookie("trio","",time()-3600,"/");
setcookie("trio_name","",time()-3600,"/");
setcookie("appoint","",time()-3600,"/");
header("location:index.php");
        ?>