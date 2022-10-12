<?php
    session_start();
    // include '../kit/static/includes/logs/logoutlog.php';
    //destroying all sessions and redirect user to login page
    session_destroy();
    header("location:../index.php");
?>