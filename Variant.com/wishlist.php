<?php
// error_reporting(0);

require "php_files/config.php";
require "php_files/database.php";

session_start();

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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Wishlist - Variant.com</title>


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
    <!-- PRODUCTS CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/products.css">
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

    <?php require "header.php"; ?>
    
    <?php
    $wishlistArr = array_filter($wishlistArr, function ($value) {
        return !empty($value);
    });
    
    if (isset($_SESSION['LOGIN']) && !empty($wishlistArr)) {
        
        $ob = new Database();
        
        $ob->sql("SELECT p.pro_id , p.image , p.name , c.cate_name , p.dis_price , p.org_price , p.discount FROM products_tbl p INNER JOIN category_tbl c ON c.cate_id = p.cate_id WHERE p.pro_id IN ( " . trim(implode(",", $wishlistArr), ",") . " ) ");
        $product = $ob->getResult();
        
        ?>
        <div class="heading_text">
            <h1 class="search_title">your wishlist</h1>
            <div class="total_products">
                <?php echo count($wishlistArr); ?> products added in wishlist
            </div>
        </div>

        <section id="products" class="products">
            <?php

if (count($product[0]) > 0) {
            ?>
                <div class="products_wrapper">
                    <?php
                    foreach ($product[0] as $val) {
                    ?>
                        <div class="pro_card">
                            <div class="wishlist">
                                <img src="assets/img/web_img/love.png" wishlist_icon alt="" class="active">
                            </div>
                            <a href="single-product.php?pro_id=<?php echo $val['pro_id'] ?>">
                                <div class="pro_img">
                                    <img src="<?php echo "assets/img/products/" . $val['image'] ?>" alt="">
                                </div>
                                <div class="pro_text">
                                    <div class="pro_title"><?php echo $val['name'] ?></div>
                                    <div class="pro_catagory"><?php echo $val['cate_name'] ?></div>
                                    <div class="pro_price">
                                        <div class="dis_price"><span>₹</span><?php echo $val['dis_price'] ?></div>
                                        <div class="org_price"><span>₹</span><?php echo $val['org_price'] ?></div>
                                        <p class="discount"><?php echo $val['discount'] ?>% OFF</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                <?php
            }
        } else {
                ?>
                <div class="container-fluid py-5" style="min-height: 80vh;">
                    <div class="empty-wishlist">
                        <img src="assets\img\web_img\empty-wishlist.jpg" alt="">
                        <h3>your wishlist is empty!</h3>
                        <p>seems like you don't have a wishes here.<br>make a wish!</p>
                        <a href="index.php" class="btn btn-dark mt-4 px-4 py-2">shop now</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <?php require "footer.php"; ?>
    </body>
    
    </html>