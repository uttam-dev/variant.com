<?php

error_reporting(0);

require "php_files/config.php";
require "php_files/database.php";
session_start();

$_SESSION['single_product']="";

if (!isset($_GET['pro_id'])) {
    header("location:index.php");
    return;
}

$ob = new Database();
$ob->select("products_tbl", "name", null, "pro_id = " . $_GET['pro_id'] . " AND `status`= '1' ");

$res = $ob->getResult();

if (empty($res)) {
    echo "<script>
    alert('Product Is Not Available');";
    return;
}

$res = $res[0];
$pro_id = $_GET['pro_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords($res['name']); ?></title>


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
    <!-- SINGLE PRODUCT CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/single-products.css">
    <!-- FOOTER CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/footer.css">


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

    <?php require "header.php";

    $pro_id = $_GET['pro_id'];
    $ob = new Database();
    $ob->select("products_tbl", "name,org_price,dis_price,discount,size,color,stock,discription,image", null, "pro_id = " . $pro_id . " AND `status`= '1' ");

    $res = $ob->getResult();
    $res = $res[0];

    $sizeArr = array("1" => "s", "2" => "m", "3" => "l", "4" => "xl", "5" => "xxl", "6" => "xxxl");
    $size = explode(",", $res['size']);

    ?>
    <form id="single_pro_form">
        <input type="hidden" value="<?php echo $pro_id; ?>" name="pro_id" id="pro_id">
        <div class="product_wrapper">
            <div class="pro_image">
                <img src="assets\img\products\<?php echo $res['image']; ?>" alt="">
            </div>
            <div class="pro_detail">
                <div class="pro_detail_wrapper">
                    <div class="text_area">
                        <div class="pro_name"><?php echo $res['name']; ?></div>
                        <div class="pro_price">
                            <div class="pro_disc_price">₹ <?php echo $res['dis_price']; ?></div>
                            <div class="pro_org_price">₹ <?php echo $res['org_price']; ?></div>
                        </div>
                        <div class="pro_sizes">
                            <div class="size_heading mb-2">Size</div>
                            <?php
                            for($key =0; $key<count($size); $key++) { ?>

                                <input type="radio" class="btn-check" name="sizes" id="<?php echo $sizeArr[$size[$key]] ?>" value="<?php echo ($size[$key]) ?>" autocomplete="off">
                                <label class="mr-3 text-uppercase" for="<?php echo $sizeArr[$size[$key]] ?>"><?php echo $sizeArr[$size[$key]] ?></label>

                            <?php
                            }
                            ?>

                        </div>
                        <div class="pro_color">
                            <div class="color_heading mb-2">Color</div>
                            <div class="color"><?php echo $res['color']; ?></div>
                        </div>

                        <div class="pro_discount">
                            <div class="flat-text mx-auto">FLAT</div>
                            <div class="discount mx-auto"><?php echo $res['discount']; ?>% OFF</div>
                        </div>
                    </div>
                    <div class="btn-control mt-5">
                        <div class="pro_qty">
                            <div class="pro_qty_control h-100">
                                <button id="qty_decrement">-</button>
                                <input type="number" value="1" readonly id="qty">
                                <button id="qty_increment">+</button>
                            </div>
                        </div>

                        <button class="add-to-cart" id="add_to_cart">ADD TO CART</button>
                        <button class="buy-now" id="buy_it_now">BUY IT NOW</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <div class="alert alert-success align-items-center w-50 data_info_alert data_info_alert-succsess " role="alert">
        <i class="fa-solid fa-circle-check mr-4"></i>
        <div>
            product succsessfully added into cart.
        </div>
    </div>

    <?php require "footer.php"; ?>

</body>

</html>