<?php

error_reporting(0);

require 'database.php';
session_start();

if (isset($_POST['cart'])) {

    $ob = new Database();

    $user_id = $_SESSION['LOGIN']['user_id'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    $pro_id = array();
    $qty = array();
    $sizes = array();

    $total_price = 0;

    foreach ($_SESSION['cart'] as $row) {
        $ob->select("products_tbl", "dis_price", null, "pro_id=" . $row['pro_id']);
        $res = $ob->getResult();

        array_push($pro_id, $row['pro_id']);
        array_push($qty, $row['qty']);
        array_push($sizes, $row['size']);

        $total_price += $row['qty'] * $res[0]['dis_price'];
    }

    $pro_id = implode(",", $pro_id);
    $qty = implode(",", $qty);
    $sizes = implode(",", $sizes);

    $values = array("user_id" => $user_id, "pro_id" => $pro_id, "sizes" => $sizes, "qty" => $qty, "total_price" =>  $total_price, "address" => $_POST['address'], "pincode" => $_POST['pincode'], "delivery_status" => 0, "confirm_status" => 1);
   
    $ob->insert("order_tbl", $values);
    $queryResult = $ob->getResult();
    
    $ob->sql("SELECT order_id FROM order_tbl WHERE user_id={$_SESSION['LOGIN']['user_id']} ORDER BY order_id DESC LIMIT 1");
    $lastOrder = $ob->getResult();
    $lastOrder = $lastOrder[0][0]['order_id'];

    $ob->sql("INSERT INTO payment_tbl (order_id,payment_method,payment_status) VALUES('$lastOrder','COD',0)");
    $ob->getResult();
    
    $_SESSION['cart'] = array();
    echo $queryResult[0];
}



if (isset($_POST['single'])) {

    $ob = new Database();

    $user_id = $_SESSION['LOGIN']['user_id'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    $ob->select("products_tbl", "dis_price", null, "pro_id=" . $_SESSION['single_product']['pro_id']);
    $res = $ob->getResult();

    $total_price += $_SESSION['single_product']['qty'] * $res[0]['dis_price'];

    $values = array("user_id" => $user_id, "pro_id" =>   $_SESSION['single_product']['pro_id'], "sizes" =>   $_SESSION['single_product']['size'], "qty" =>   $_SESSION['single_product']['qty'], "total_price" =>  $total_price, "address" => $address, "pincode" => $pincode, "delivery_status" => 0, "confirm_status" => 1);

    $ob->insert("order_tbl", $values);
    $queryResult = $ob->getResult();

    $ob->sql("SELECT order_id FROM order_tbl WHERE user_id={$_SESSION['LOGIN']['user_id']} ORDER BY order_id DESC LIMIT 1");
    $lastOrder = $ob->getResult();
    $lastOrder = $lastOrder[0][0]['order_id'];
    
    $ob->sql("INSERT INTO payment_tbl (order_id,payment_method,payment_status) VALUES('$lastOrder','COD',0)");
    $ob->getResult();
    

    $_SESSION['single_product'] = "";
    echo $queryResult[0];
}
