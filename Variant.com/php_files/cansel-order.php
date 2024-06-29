<?php
error_reporting(0);
require 'config.php';
require 'database.php';

$pro_id = mysqli_real_escape_string($conn, $_POST['pro_id']);
$order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

$ob = new Database();
$ob->select("order_tbl", "*", null, "order_id = " . $order_id);
$orderDetails = $ob->getResult();

$products_id = explode(",", trim($orderDetails[0]['pro_id'], ","));
$sizes = explode(",", trim($orderDetails[0]['sizes'], ","));
$qty = explode(",", trim($orderDetails[0]['qty'], ","));

$count = count($products_id);


    for ($index = 0; $index < $count; $index++) {
        if ($products_id[$index] == $pro_id) {
            array_splice($products_id, $index, 1);
            array_splice($sizes, $index, 1);
            array_splice($qty, $index, 1);
            break;
        }
    }

if (empty($products_id)) {
    $ob->delete("order_tbl", "order_id = " . $order_id);
   $res = $ob->getResult();
   echo 1;
} 
else {

    $products_id = trim(implode(",", $products_id));
    $sizes = trim(implode(",", $sizes), ",");
    $qty = trim(implode(",", $qty), ",");

    $ob->sql("UPDATE order_tbl SET pro_id = '$products_id', sizes = '$sizes', qty = '$qty' WHERE order_id = " . $order_id);
    $result = $ob->getSql();
    echo 1;
}
