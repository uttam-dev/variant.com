<?php 

error_reporting(0);

require 'config.php';
require 'database.php';

$email = strtolower(trim(mysqli_real_escape_string($conn, $_POST['feed_email'])));
$massage = strtolower(trim(mysqli_real_escape_string($conn, $_POST['feed_massage'])));

$ob = new Database();
$ob->sql("INSERT INTO feedback_tbl (email,massage) VALUES ('$email','$massage')");
$res = $ob->getResult();

if(!empty($res)){
    print_r($res);
}
else{
    echo $res[0][0];
}

?>