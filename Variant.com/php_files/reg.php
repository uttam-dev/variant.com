<?php 

error_reporting(0);

    require 'config.php';
    require 'database.php';

    $name = strtolower(trim(mysqli_escape_string($conn, $_POST['name'])));
    $email = strtolower(trim(mysqli_escape_string($conn,$_POST['email'])));
    $mobile = strtolower(trim(mysqli_escape_string($conn,$_POST['mobile'])));
    $address = strtolower(trim(mysqli_escape_string($conn,$_POST['address'])));
    $password =md5(strtolower(trim(mysqli_escape_string($conn,$_POST['password']))));
    

    $ob = new Database();
    $ob->sql("SELECT `email` FROM `user_tbl` WHERE email ='$email'");
    $res = $ob->getResult();
    $res = $res[0];
    
    if(empty($res))
    {
        $values = array("full_name" => $name,"email" => $email,"phone_number" => $mobile ,"address" => $address,"password" => $password,"active_status" => 1);
        $ob->insert("user_tbl",$values);
        $res = $ob->getResult();
        $res = $res[0];
    }
    else{
        echo "exist";
    }

?>