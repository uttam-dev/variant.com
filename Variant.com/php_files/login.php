<?php

error_reporting(0);

require 'config.php';
require 'database.php';
session_start();

// ONLY CHECK LOGIN OR NOT
if (isset($_POST['check_login'])) {
    if (isset($_SESSION['LOGIN'])) {
        echo 1;
        return;
    } else {
        echo 0;
        return;
    }
}



// LOGIN PROCESS
$emailOrUsername = strtolower(trim(mysqli_real_escape_string($conn, $_POST['email'])));
$password = strtolower(trim(mysqli_real_escape_string($conn, $_POST['pass'])));


$ob = new Database();
$ob->sql("SELECT `user_id`,`full_name`,`email`,`password` FROM `user_tbl` WHERE email ='$emailOrUsername'");

$res = $ob->getResult();
$res = $res[0];


if (empty($res)) {
    
    $ob->sql("SELECT `id`,`username`,`password` FROM `admin_tbl` WHERE username ='$emailOrUsername'");
    
    $queryAdmin = $ob->getResult();
    $queryAdmin = $queryAdmin[0];

    if(!empty($queryAdmin)){
        if($queryAdmin[0]['password'] == md5($password)){
            $_SESSION['ADMIN_LOGIN']['username']=$queryAdmin[0]['username'];
            echo "admin_succsess";
        }
        else{
            echo "pass_err";
        }
    }
    else{
        echo "email_err";
    }
    return;
    
} else {
  
    if ($res[0]['password'] == md5($password)) {
        $_SESSION['LOGIN']['user_id'] = $res[0]['user_id'];
        $_SESSION['LOGIN']['username'] = $res[0]['full_name'];
        $_SESSION['LOGIN']['email'] = $res[0]['email'];
        echo "success";
        if (isset($_GET['ref'])) {
            header("location:" . $_GET['ref']);
        }
    } else {
        echo "pass_err";
    }
}
