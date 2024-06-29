<?php

error_reporting(0);

require 'config.php';
require 'database.php';

$email = strtolower(trim(mysqli_real_escape_string($conn, $_POST['email'])));
$password = md5(strtolower(trim(mysqli_real_escape_string($conn, $_POST['pass']))));

$ob = new Database();
$ob->sql("SELECT `email`,`password` FROM `user_tbl` WHERE email ='$email'");
$res = $ob->getResult();
$res = $res[0];

if($password == $res[0]['password']){
    echo "password alredy exist";
    return;
}

if (empty($res)) {
    echo "email_err";
}
else {
    $ob = new Database();
    $ob->sql("UPDATE `user_tbl` SET `password`= '$password' WHERE `email`= '{$email}'");
    $res = $ob->getResult();
    $res = $res[0];

    if(empty($res)){
        echo "pass_err";
    }
    else{
        echo "success";
    }
}
