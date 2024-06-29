<?php
error_reporting(0);
require "php_files/config.php";
require "php_files/database.php";

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Variant.com</title>


    <!-- FAVICON LINK -->
    <link rel="shortcut icon" href="assets\img\web_img\variant_favicon.png" type="image/x-icon">
    <!-- FONT AWSOME CDN FOR ALL-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- FONT AWSOME CDN  FOR REGULAR -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/regular.min.css" />


    <!--  BOOTSTRAP CSS (LIBRARY) -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!--  FONTAWSOME CSS (LIBRARY) -->
    <link rel="stylesheet" href="assets/css/all.css">
    <!-- UTILITY CSS CLASESS (SELF)-->
    <link rel="stylesheet" href="assets/css/utility.css">
    <!-- GOLABAL NAV CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/header.css">
    <!-- FOOTER  CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- ORDERS PAGE CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/orders.css">


    <!-- J QUERY JS (LIBRARY) -->
    <script src="assets/js/jquery.js" type="text/javascript" defer></script>
    <!-- BOOTSTRAP JS (LIBRARY) -->
    <script src="assets/js/bootstrap.js" type="text/javascript" defer></script>
    <!-- FONTAWSOME JS (SELF) -->
    <script src="assets/js/all.js" type="text/javascript" defer></script>
    <!-- ANIMATION JS (SELF) -->
    <script src="assets/js/animation.js" type="text/javascript" defer></script>
    <!-- ACTION JS (SELF) -->
    <script src="assets/js/action.js" type="text/javascript" defer></script>

</head>

<body>

    <?php require "header.php"; ?>

    <!-- ************** BREADCRUMB ************** -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 mt-2">
            <li class="breadcrumb-item ml-5"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>


    <ul class="sub-nav">
        <li class="sub-nav-iteam">
            <a href="cart.php">my cart</a>
        </li>
        <li class="sub-nav-iteam active">
            <a href="orders.php">my orders</a>
        </li>
    </ul>

    <?php
    if (isset($_SESSION['LOGIN'])) {
        $ob = new Database();
        $ob->select("order_tbl", "order_id", null, "user_id =" . $_SESSION['LOGIN']['user_id']);
        $chekOrder = $ob->getResult();

        if (!empty($chekOrder) && count($chekOrder[0]) > 0) {

    ?>

            <ul class="cart_wrapper" style="min-height: 80vh;">


                <li class="cart_heading">
                    <div class="order_id">order id</div>
                    <div class="product">products</div>
                    <div class="desc"></div>
                    <div class="qty">quantity</div>
                    <div class="total">total</div>
                    <div class="confirem_status">confirm status</div>
                    <div class="delivery_status">delivery</div>
                    <div class="order_date">order date</div>
                </li>

                <?php

                $ob = new Database();
                $payment = new Database();
                $ob->select("order_tbl", "*", null, "user_id=" . $_SESSION['LOGIN']['user_id'] , "order_id DESC");
                $resOrder = $ob->getResult();

                foreach ($resOrder as $resultOrder) {

                    $sizeArr = array("1" => "s", "2" => "m", "3" => "l", "4" => "xl", "5" => "xxl", "6" => "xxxl");
                    $pro_id = explode(",", $resultOrder['pro_id']);
                    $sizes = explode(",", $resultOrder['sizes']);
                    $qty = explode(",", $resultOrder['qty']);


                    $payment = new Database();
                    $payment->select("payment_tbl", "*", null, "order_id={$resultOrder['order_id']}");
                    $resPayment = $payment->getResult();
                    $resPayment = $resPayment[0];

                    $payment_status = $resPayment['payment_status'] == 1 ? "paid" : "pending";
                    $payment_method = "(".$resPayment['payment_method'].")";

                ?>

                    <?php

                    for ($i = 0; $i < count($pro_id); $i++) {

                        $ob->select("products_tbl", "name,discription,color,dis_price,image", null, "pro_id=" . $pro_id[$i]);
                        $res = $ob->getResult();
                        $products = $res[0];
                    ?>
                        <form method="POST">

                            <li class="cart_iteam">
                                <div class="order_id">
                                    <p><?php echo $resultOrder['order_id']; ?></p>
                                </div>

                                <div class="cart_img">
                                    <img src="assets\img\products\<?php echo $products['image']; ?>" alt="">
                                </div>
                                <div class="pro_detail">
                                    <div class="pro_name"><?php echo $products['name']; ?></div>
                                    <div class="pro_desc"><?php echo $products['discription'] ?></div>
                                    <div class="pro_size_color"><span class="text-uppercase"><?php echo $sizeArr[$sizes[$i]] . "</span> / <span> " . $products['color'] ?></span></div>
                                </div>
                                <div class="pro_qty">
                                    <div class="pro_qty_control">
                                        <p><?php echo $qty[$i]; ?></p>

                                    </div>
                                </div>
                                <div class="pro_total">
                                    rs. <?php echo $products['dis_price'] * $qty[$i]; ?>
                                </div>

                                <?php
                                $confirem_status = $resultOrder['confirm_status'] == 1 ? "confirm" : "cancelled";
                                $delivery_status = $resultOrder['delivery_status'] == 1 ? "delivered" : "order processing";
                                $order_date = explode(" ", date("d-M-Y g:i:s:a", strtotime($resultOrder['order_date'])));
                                if($confirem_status == "cancelled"){
                                    $delivery_status="";
                                    $payment_method="";
                                    $payment_status = "cancelled";
                                }
                                
                                ?>
                                <div class="confirem_status"><?php echo $confirem_status; ?></div>
                                <div class="delivery_status">

                                    <?php echo $delivery_status ?><?php ?>
                                    <div class="payment_status">
                                        <div>payment : </div>
                                        <?php echo $payment_status ?> <span class="text-uppercase"><?php echo $payment_method ?></span>
                                    </div>

                                </div>
                                <div class="order_date"><?php echo $order_date[0] . "<br>" . $order_date[1]; ?>
                                    <?php ?>
                                    <?php if ($delivery_status == "order processing" && $confirem_status == "confirm") { ?>
                                        <a class="cansel_btn" data-order-id="<?php echo $resultOrder['order_id']; ?>" data-pro-id="<?php echo $pro_id[$i]; ?>">
                                            <i class="fa-solid fa-x"></i>&nbsp;&nbsp;<span class="cansel_btn_text">cancel</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </li>
                        </form>
                <?php
                    }
                } ?>
            </ul>


        <?php
        } else { ?>
            <div class="container-fluid" style="min-height: 80vh;">
                <!-- FOR EMPTY ORDER -->
                <div class="empty-order">
                    <img src="assets\img\web_img\empty-order.jpg" alt="">
                    <h3>your order history is empty.</h3>
                    <p>start shopping now to fill it with amazing clothes..</p>
                    <a href="index.php" class="btn btn-dark mt-4 px-4 py-2">shop now</a>
                </div>

            <?php }
    } else {
            ?>
            <div class="empty-order not-login" style="min-height: 80vh;">
                <img src="assets\img\web_img\not-login.png" alt="" class="mt-5">
                <h3 class="mt-3">you are not logged in.</h3>
                <p>please log in to view and track your order.</p>
                <a href="login.php?ref=orders.php" class="btn btn-dark mt-4 px-4 py-2">login now</a>
            </div>

        <?php } ?>
            </div>


            <div id="op"></div>
            <?php require "footer.php"; ?>
</body>

</html>