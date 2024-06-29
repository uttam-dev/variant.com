<?php
error_reporting(0);
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



if (isset($_GET['cate_id'])) {
    $ob = new Database();
    $ob->select("category_tbl", "cate_name", null, "cate_id={$_GET['cate_id']}");
    $product = $ob->getResult();

    $webTitle = $product[0]['cate_name'];
    $searchResults = $product[0]['cate_name'];

    $ob->sql("SELECT  p.pro_id , p.name , p.image , p.org_price , p.dis_price , p.discount , c.cate_name FROM products_tbl p INNER JOIN category_tbl c ON p.cate_id = c.cate_id WHERE p.cate_id=" . $_GET['cate_id']);
    $product = $ob->getResult();
}


if (isset($_GET['sub_cate_id'])) {
    $ob = new Database();
    $ob->select("sub_category_tbl", "sub_cate_name", null, "sub_cate_id={$_GET['sub_cate_id']}");
    $product = $ob->getResult();

    $webTitle = $product[0]['sub_cate_name'];
    $searchResults = $product[0]['sub_cate_name'];

    $ob->sql("SELECT  p.pro_id , p.name , p.image , p.org_price , p.dis_price , p.discount , c.cate_name FROM products_tbl p INNER JOIN category_tbl c ON p.cate_id = c.cate_id WHERE p.sub_cate_id=" . $_GET['sub_cate_id']);
    $product = $ob->getResult();
}


if (isset($_GET['search'])) {

    $webTitle = urldecode($_GET['search']);
    $searchResults = urldecode($_GET['search']);

    $ob = new Database();
    $ob->sql("SELECT p.pro_id , p.name , p.image , p.org_price , p.dis_price , p.discount , c.cate_name FROM products_tbl p INNER JOIN category_tbl c ON p.cate_id = c.cate_id WHERE `name` LIKE '%{$searchResults}%' OR `discription` LIKE '%{$searchResults}%'");
    $product = $ob->getResult();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords($webTitle); ?></title>


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


    <!-- Not Login Modal -->

    <div class="modal fade mt-5 text-capitalize" id="notLogInModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-lg">
                    <h3 class="modal-title font_rob font-weight-bolder mx-auto">you are not login !! </h3>
                </div>
                <div class="modal-body py-5 d-flex justify-content-center align-items-center">
                    <h3>please login to add product in wishlist..</h3>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-dark rounded-sm mr-3 px-4" data-bs-dismiss="modal">Cansel</a>
                    <a class="btn btn-dark rounded-sm px-4" href="login.php?ref=index.php">Login</a>
                </div>
            </div>
        </div>
    </div>


    <div class="heading_text">
        <h1 class="search_title">search results : <?php echo $searchResults; ?></h1>
        <div class="total_products">
            <?php echo count($product[0]); ?> products
        </div>
    </div>

    <section id="products" class="products">
        <?php
        if (count($product[0]) > 0) {
        ?>
            <div class="products_wrapper">
                <?php

                foreach ($product[0] as $key => $val) {
                    $isInWishlist = in_array($val['pro_id'], $wishlistArr) ? "active" : "";
                ?>
                    <div class="pro_card">
                        <div class="wishlist">
                            <img src="assets/img/web_img/love.png" wishlist_icon alt="" class="<?php echo $isInWishlist; ?>">
                        </div>
                        <a href="single-product.php?pro_id=<?php echo $val['pro_id'] ?>" class="">
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
        } else {
            ?>
                <div class="container-fluid py-5" style="margin-bottom: 14rem;">
                    <h1 class="mx-auto my-5 w-25 text-center">oops!! products not found !!</h1>
                </div>
            <?php
        }
            ?>
            </div>
    </section>
    <?php require "footer.php"; ?>
</body>

</html>