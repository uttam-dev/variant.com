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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variant.com</title>


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
    <!-- MAIN HOME PAGE CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOOTER  CSS (SELF)-->
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


    <!-- <div data-scroll-container> -->



    <!-- HOME PAGE MAIN CONTENT START......... -->

    <section id="product_catagory" class="product_catagory btn_container">
        <button class="btn left_button left" data-carouselBtnLeft="product_catagory"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="btn right_button right" data-carouselBtnRight="product_catagory"><i class="fa-solid fa-angle-right"></i></button>

        <div class="cart_wrapper" carouselSlider="product_catagory">

            <?php
            $ob = new Database();
            $ob->sql("SELECT `cate_id`,`cate_name`,`image` FROM category_tbl WHERE `status`= 1");
            $res = $ob->getResult();
            $res = $res[0];

            foreach ($res as $row) { ?>

                <a href='products.php?cate_id=<?php echo $row['cate_id']; ?>'>
                    <div class='cart'>
                        <div class='cart_image'>
                            <img src="<?php echo "assets/img/product_catagory/" . $row['image']; ?>" lazy>
                        </div>
                        <div class='cart_title'>
                            <h5>
                                <?php echo $row['cate_name']; ?>
                            </h5>
                        </div>
                    </div>
                </a>

            <?php } ?>
        </div>
    </section>

    <section id="banner-1" class="banner_container" banner_container>

        <div class="image_wrapper" data-image_wrapper>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp1.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp2.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp3.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp4.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp5.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp6.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp7.jpg" alt="">
            </a>
        </div>

        <div class="indicator" indicator>
            <ul>
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </section>

    <section id="popular_products" class="popular_products">
        <h1 class="text_underline">POPULAR PRODUCTS</h1>

        <div class="btn_container ">
            <button class="btn left_button left" data-carouselBtnLeft="popular_products"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="btn right_button right" data-carouselBtnRight="popular_products"><i class="fa-solid fa-angle-right"></i></button>

            <div class="products_container" carouselSlider="popular_products">
                <?php
                $ob = new Database();
                $ob->sql("SELECT  p.pro_id , p.name , p.image , p.org_price , p.dis_price , p.discount, c.cate_name FROM products_tbl p INNER JOIN category_tbl c ON p.cate_id = c.cate_id WHERE p.stock > 0 AND p.status = 1 ORDER BY RAND() LIMIT 10");
                $res = $ob->getResult();

                if (count($res[0]) > 0) {

                    foreach ($res[0] as $key => $val) {

                        $isInWishlist = in_array($val['pro_id'], $wishlistArr) ? "active" : "";

                ?>
                        <div class="pro_card">
                            <div class="wishlist">
                                <img src="assets/img/web_img/love.png" wishlist_icon alt="" class="<?php echo $isInWishlist; ?>">
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
                }
                ?>
            </div>
        </div>
    </section>


    <section id="banner-2" class="banner_container" banner_container>

        <div class="image_wrapper" data-image_wrapper>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp6.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp4.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp1.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp5.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp2.jpg" alt="">
            </a>
        </div>

        <div class="indicator" indicator>
            <ul>
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </section>


    <section id="latest_arrival" class="latest_arrival">
        <h1 class="text_underline">LATEST ARIVELS</h1>

        <div class="btn_container ">
            <button class="btn left_button left" data-carouselBtnLeft="latest_arrival"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="btn right_button right" data-carouselBtnRight="latest_arrival"><i class="fa-solid fa-angle-right"></i></button>

            <div class="products_container" carouselSlider="latest_arrival">

                <?php
                $ob = new Database();
                $ob->sql("SELECT  p.pro_id , p.name , p.image , p.org_price , p.dis_price , p.discount, c.cate_name FROM products_tbl p INNER JOIN category_tbl c ON p.cate_id = c.cate_id WHERE p.stock > 0 AND p.status = 1 ORDER BY RAND() LIMIT 10");
                $res = $ob->getResult();

                if (count($res[0]) > 0) {

                    foreach ($res[0] as $key => $val) {
                        $isInWishlist = in_array($val['pro_id'], $wishlistArr) ? "active" : "";
                ?>

                        <div class="pro_card">
                            <div class="wishlist">
                                <img src="assets/img/web_img/love.png" wishlist_icon alt="" class="<?php echo $isInWishlist; ?>">
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
                }
                ?>
            </div>
        </div>
    </section>


    <section id="banner-3" class="banner_container" banner_container>

        <div class="image_wrapper" data-image_wrapper>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp5.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp4.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp2.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp6.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp3.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp1.jpg" alt="">
            </a>
            <a href="#" data-images>
                <img src="assets\img\product_templetes\temp7.jpg" alt="">
            </a>
        </div>

        <div class="indicator" indicator>
            <ul>
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </section>


    <section id="variant_orignal" class="variant_orignal">
        <h1 class="text_underline">VARIANT ORIGNAL</h1>

        <div class="btn_container ">
            <button class="btn left_button left" data-carouselBtnLeft="variant_orignal"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="btn right_button right" data-carouselBtnRight="variant_orignal"><i class="fa-solid fa-angle-right"></i></button>

            <div class="products_container" carouselSlider="variant_orignal">

                <?php
                $ob = new Database();
                $ob->sql("SELECT  p.pro_id , p.name , p.image , p.org_price , p.dis_price , p.discount, c.cate_name FROM products_tbl p INNER JOIN category_tbl c ON p.cate_id = c.cate_id WHERE p.stock > 0 AND p.status = 1 ORDER BY RAND() LIMIT 10");
                $res = $ob->getResult();

                if (count($res[0]) > 0) {

                    foreach ($res[0] as $key => $val) {
                        $isInWishlist = in_array($val['pro_id'], $wishlistArr) ? "active" : "";
                ?>

                        <div class="pro_card">
                            <div class="wishlist">
                                <img src="assets/img/web_img/love.png" wishlist_icon alt="" class="<?php echo $isInWishlist; ?>">
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
                }
                ?>

            </div>
        </div>
    </section>
    <div id="op"></div>
    <!-- HOME PAGE MAIN CONTENT END........... -->

    <?php require "footer.php"; ?>


</body>

</html>