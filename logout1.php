<?php
            session_start();
session_destroy();
setcookie("triod","",time()-3600,"/");
setcookie("triod_name","",time()-3600,"/");
setcookie("appoint","",time()-3600,"/");
header("location:index.php");
        ?>