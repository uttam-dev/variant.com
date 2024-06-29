<?php

error_reporting(0);
require "php_files/config.php";
require "php_files/database.php";

session_start();


if (isset($_GET['cart'])) {
    unset($_SESSION['cart'][$_GET['cart']]);
}

if (isset($_SESSION['cart'])) {

    if (isset($_POST['decrement'])) {

        $qty_count = $_POST['qty'];

        if ($qty_count > 1) {
            --$qty_count;
            $_SESSION['cart'][$_POST['cart']]['qty'] = $qty_count;
        }
    }

    if (isset($_POST['increment'])) {
        $qty_count = $_POST['qty'];
        if ($qty_count < 10) {
            ++$qty_count;
            $_SESSION['cart'][$_POST['cart']]['qty'] = $qty_count;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Variant.com</title>


    <!-- FAVICON LINK -->
    <link rel="shortcut icon" href="assets\img\web_img\variant_favicon.png" type="image/x-icon">
    <!-- FONT AWSOME CDN FOR ALL-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" /> -->
    <!-- FONT AWSOME CDN  FOR REGULAR -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/regular.min.css" /> -->


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
    <!-- CART AND ORDERS PAGE CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/cart.css">


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
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>


    <ul class="sub-nav">
        <li class="sub-nav-iteam active">
            <a href="cart.php">my cart</a>
        </li>
        <li class="sub-nav-iteam">
            <a href="orders.php">my orders</a>
        </li>
    </ul>

    <div class="container-fluid" style="min-height: 80vh;">

        <!-- FOR EMPTY CART -->
        <?php
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        ?>
            <div class="empty-cart mt-5 pt-5">
                <img src="assets\img\web_img\empty-cart.png" alt="">
                <h3>your cart is empty.</h3>
                <p>start shopping now to fill it with amazing clothes..</p>
                <a href="index.php" class="btn btn-dark mt-4 px-4 py-2">shop now</a>
            </div>

        <?php return;
        } ?>



        <!-- ************************* LEFT SIDE TOTAL CONTAINER ************************* -->
        <?php if (isset($_SESSION['cart'])) { ?>
            <div class="left-wrapper">
                <ul class="cart_wrapper">
                    <?php $ob = new Database(); ?>

                    <li class="cart_heading">
                        <div class="product">products</div>
                        <div class="desc"></div>
                        <div class="price">price</div>
                        <div class="qty">quantity</div>
                        <div class="total">total</div>
                    </li>

                    <?php
                    $total_price = 0;
                    $sizeArr = array("1" => "s", "2" => "m", "3" => "l", "4" => "xl", "5" => "xxl", "6" => "xxxl");

                    foreach ($_SESSION['cart'] as $row) {

                        $ob->select("products_tbl", "name,discription,color,dis_price,image", null, "pro_id=" . $row['pro_id']);
                        $res = $ob->getResult();
                        $res = $res[0];
                        $total_price += $res['dis_price'] * $row['qty'];
                    ?>
                        <form method="POST">
                            <input type="hidden" name="cart" value="<?php echo $row['cart']; ?>">
                            <li class="cart_iteam">
                                <div class="cart_img">
                                    <img src="assets\img\products\<?php echo $res['image']; ?>" alt="">
                                </div>
                                <div class="pro_detail">
                                    <div class="pro_name"><?php echo $res['name']; ?></div>
                                    <div class="pro_desc"><?php echo $res['discription'] ?></div>
                                    <div class="pro_size_color"><span class="text-uppercase"><?php echo $sizeArr[$row['size']] . "</span> / <span> " . $res['color'] ?></span></div>
                                </div>
                                <div class="pro_price">
                                    rs. <?php echo $res['dis_price'] ?>
                                </div>
                                <div class="pro_qty">
                                    <div class="pro_qty_control">
                                        <button type="submit" name="decrement">-</button>
                                        <input type="number" value="<?php echo $row['qty']; ?>" name="qty" readonly id="qty">
                                        <button type="submit" name="increment">+</button>
                                    </div>
                                </div>
                                <div class="pro_total">
                                    rs. <?php echo $res['dis_price'] * $row['qty']; ?>
                                    <a href="?cart=<?php echo $row['cart']; ?>" class="cart_remove">
                                        <i class="fa-solid fa-x"></i>&nbsp;&nbsp;remove
                                    </a>
                                </div>
                            </li>
                        </form>
                    <?php
                    } ?>
                </ul>
            </div>


            <!-- ************************* RIGHT SIDE TOTAL CONTAINER ************************* -->
            <div class="right-wrapper">
                <div class="sub_total_wrapper">
                    <div class="delivery_info d-flex align-items-center my-2">
                        <?php if ($total_price < 1000) { ?>
                            <i class="fa-solid fa-circle-info text-info p-0 m-0 mt-1 mr-1" style="font-size: 1rem; align-self:flex-start"></i>
                            <p class="ml-1">Add <span class="font_rob" style="font-weight: 900;"> ₹<?php echo 1000 - $total_price; ?></span> of eligible items to your order to qualify for FREE Delivery</p>
                        <?php
                        } else { ?>
                            <i class="fa-solid fa-circle-check btn text-success p-0 m-0" style="font-size: 1rem; align-self:flex-start"></i>
                            <p class="ml-1">Your order is eligible for FREE Delivery.</p>
                        <?php } ?>

                    </div>
                    <div class="total_info font-bolder">

                        <h3 class="my-3">prices details</h3>

                        <hr class="my-2 m-0">

                        <div class="total_product_iteam d-flex align-items-center justify-content-between my-3">
                            <p>total product iteam &nbsp;&nbsp;&nbsp;:</p>
                            <p><?php echo count($_SESSION['cart']); ?></p>
                        </div>

                        <div class="additional_fees d-flex align-items-center justify-content-between my-3">
                            <p> additional fee &nbsp;&nbsp;&nbsp;:</p>
                            <p><span>₹</span><?php
                                                $total_price += $total_price > 1000 ? 0 : 100;
                                                echo $total_price > 1000 ? 0 : 100; ?></p>
                        </div>
                        <hr class="my-2 m-0">

                        <div class="total_product_price d-flex align-items-center justify-content-between my-3">
                            <h4>total product price &nbsp;&nbsp;&nbsp;:</h4>
                            <h4><span>₹</span><?php echo $total_price; ?></h4>
                        </div>
                        <a href="process-order.php" class="btn btn-dark my-2 place_order_btn" id="-cart-place-order-btn">process order</a>
                    </div>
                </div>
            </div>

        <?php } ?>

    </div>

    <?php require 'footer.php'; ?>

</body>

</html>