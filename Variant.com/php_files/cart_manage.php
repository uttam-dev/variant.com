<?php

error_reporting(0);

session_start();

if(isset($_POST['buy_it_now'])){
    
   $_SESSION['single_product']['pro_id'] = $_POST['pro_id'];
   $_SESSION['single_product']['size'] = $_POST['size'];
   $_SESSION['single_product']['qty'] = $_POST['qty'];

   echo 1;
   return;
}

if (isset($_SESSION['cart'])) {

    $count = count($_SESSION['cart']);

    for ($index = 0; $index < $count; $index++) {
        if ($_SESSION['cart'][$index]['pro_id'] === $_POST['pro_id']) {
            echo "Product Is Already Exist In Cart";
            return;
        }
    }

    $_SESSION['cart'][$count] = array(
        "cart"=>$count ,"pro_id" => $_POST['pro_id'],
        "size" => $_POST['size'], "qty" => $_POST['qty']
    );
    echo count($_SESSION['cart']);
} else {

    $_SESSION['cart'][0] = array("cart"=> 0,
        "pro_id" => $_POST['pro_id'],
        "size" => $_POST['size'], "qty" => $_POST['qty']
    );
    echo count($_SESSION['cart']);
}
