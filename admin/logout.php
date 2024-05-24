<?php
    session_start();
    
    unset($_SESSION["email"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_type"]);


    header("Location: ../login.html");
?>
