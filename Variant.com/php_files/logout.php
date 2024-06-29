<?php

error_reporting(0);

    session_start(); 
    session_unset();
    session_destroy();

    if(isset($_GET['ref'])){
        header("location:../".$_GET['ref']);
    }
    else{
        header("location:../login.php");
    }

?>