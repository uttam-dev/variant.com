<?php

error_reporting(0);

require 'database.php';
require 'config.php';

$username = strtolower(trim(mysqli_real_escape_string($conn, $_POST['username'])));
$password = md5(strtolower(trim(mysqli_real_escape_string($conn, $_POST['pass']))));

$ob = new Database();
$ob->sql("SELECT `username`,`password` FROM `admin_tbl` WHERE username ='$username'");
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
    $ob->sql("UPDATE `admin_tbl` SET `password`= '$password' WHERE `username`= '{$username}'");
    $res = $ob->getResult();
    $res = $res[0];

    if(empty($res)){
        echo "pass_err";
    }
    else{
        echo "success";
    }
}
