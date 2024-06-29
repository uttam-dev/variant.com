<?php
error_reporting(0);

require 'database.php';
require 'config.php';

session_start();

// LOGIN PROCESS
$emailOrUsername = strtolower(trim(mysqli_real_escape_string($conn, $_POST['email'])));
$password = strtolower(trim(mysqli_real_escape_string($conn, $_POST['pass'])));


$ob = new Database();
$ob->sql("SELECT `id`,`username`,`password` FROM `admin_tbl` WHERE username ='$emailOrUsername'");

$queryAdmin = $ob->getResult();
$queryAdmin = $queryAdmin[0];

    if(!empty($queryAdmin)){
        if($queryAdmin[0]['password'] == md5($password)){
            $_SESSION['ADMIN_LOGIN']['username']=$queryAdmin[0]['username'];
            echo "success";
        }
        else{
            echo "pass_err";
        }
    }
    else{
        echo "email_err";
    }
    
