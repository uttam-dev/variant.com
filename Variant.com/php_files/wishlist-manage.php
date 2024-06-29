<?php
error_reporting(0);

require 'config.php';
require 'database.php';

session_start();
$ob = new Database();

$wishlistArr = array();
if (isset($_SESSION['LOGIN'])) {
    $ob = new Database();
    $ob->select("wishlist_tbl", "*", null, "user_id=" . $_SESSION['LOGIN']['user_id']);
    $result = $ob->getResult();
    if (!empty($result)) {
        $wishlistArr = explode(",", trim($result[0]['pro_id'], ","));
    }
    $wishlistArr = array_unique($wishlistArr);
    $wishlistArr = array_filter($wishlistArr, function ($value) {
        return !empty($value);
    });
} else {
    echo "not login";
    return;
}

if (isset($_POST['remove'])) {
    $pro_id = $_POST['pro_id'];
    $index = array_search($pro_id, $wishlistArr);
    array_splice($wishlistArr, $index, 1);
    $wishlist_pro_id = implode(",", $wishlistArr);
    $ob->update("wishlist_tbl", array("pro_id" => $wishlist_pro_id), "user_id = " . $_SESSION['LOGIN']['user_id']);
    $result = $ob->getResult();
    echo 1;
}

if (isset($_POST['add'])) {

    $pro_id = $_POST['pro_id'];

    $ob->sql("SELECT COUNT(*) AS count FROM wishlist_tbl WHERE user_id=" . $_SESSION['LOGIN']['user_id']);
    $count = $ob->getResult();

    
    if ($count[0][0]['count'] > 0) {
        
        array_push($wishlistArr,$pro_id);
        
        $ob->sql("UPDATE wishlist_tbl SET pro_id = '".trim(implode(",",$wishlistArr),",")."'");
        $result = $ob->getResult();
        // echo json_encode($result);
        echo 1;
    } else {
        $ob->sql("INSERT INTO wishlist_tbl (user_id,pro_id) VALUES ({$_SESSION['LOGIN']['user_id']},CONCAT(pro_id,',{$pro_id}'))");
        $result = $ob->getResult();
        echo 1;
    }
}
