<?php
    session_start();
    $_SESSION['ID']="";
    $_SESSION['name']="";
    $_SESSION['level']="";

    header("Location:message.php?message=已登出");

?>