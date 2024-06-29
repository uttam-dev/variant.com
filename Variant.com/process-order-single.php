<?php
error_reporting(0);
require "php_files/config.php";
require "php_files/database.php";
session_start();

if (!isset($_SESSION['single_product'])) {
    header("location:index.php");
} else {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Process Order</title>


        <!-- FAVICON LINK -->
        <link rel="shortcut icon" href="assets\img\web_img\variant_favicon.png" type="image/x-icon">
        <!-- FONT AWSOME CDN FOR ALL-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <!-- FONT AWSOME CDN  FOR REGULAR -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/regular.min.css" />


        <!--  BOOTSTRAP CSS (LIBRARY) -->
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <!-- UTILITY CSS CLASESS (SELF)-->
        <link rel="stylesheet" href="assets/css/utility.css">
        <!-- GOLABAL NAV CSS (SELF)-->
        <link rel="stylesheet" href="assets/css/header.css">
        <!-- PRODUCTS CSS (SELF)-->
        <link rel="stylesheet" href="assets/css/process-order.css">
        <!-- FOOTER CSS (SELF)-->
        <link rel="stylesheet" href="assets/css/footer.css">


        <!-- J QUERY JS (LIBRARY) -->
        <script src="assets/js/jquery.js" type="text/javascript" defer></script>
        <!-- BOOTSTRAP JS (LIBRARY) -->
        <script src="assets/js/bootstrap.js" type="text/javascript" defer></script>
        <!-- ANIMATION JS (SELF) -->
        <script src="assets/js/animation.js" type="text/javascript" defer></script>
        <!-- ACTION JS (SELF) -->
        <script src="assets/js/action.js" type="text/javascript" defer></script>

    </head>

    <body>

        <?php require "header.php"; ?>

              <!-- SUCCSESSFUL MASSAGE FOR ORDER PLACED  -->

        <!-- Modal -->

        <div class="modal fade" id="orderSuccsessMassage" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius:2rem;">
                    <div class="modal-header d-flex justify-content-center">
                        <b>
                            <h3 class="modal-title fs-5 text-center" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif">Thanks For Shopping From Us</h3>
                        </b>
                    </div>
                    <div class="modal-body py-0 d-flex justify-content-center align-items-center">
                        <img src="assets/img/web_img/thank-you.gif" alt="" style="width:50%;mix-blend-mode:hard-light; ">
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-iteam-center">
                        <a href="order.php" class="btn btn-dark px-3" data-bs-dismiss="modal">Check Order Details</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- PRODUCT DETAILS AND FORM  -->
        <?php
        $ob = new Database();
        $ob->select("user_tbl", "*", null, "email = '{$_SESSION['LOGIN']['email']}'");
        $res = $ob->getResult();
        $res = $res[0];

        $total_price = 0;
        $sizeArr = array("1" => "s", "2" => "m", "3" => "l", "4" => "xl", "5" => "xxl", "6" => "xxxl");

        $ob->select("products_tbl", "dis_price", null, "pro_id=" . $_SESSION['single_product']['pro_id']);
        $result = $ob->getResult();
        $result = $result[0];
        $total_price += $result['dis_price'] * $_SESSION['single_product']['qty'];


        ?>

        <div class="container-fluid py-3" style="padding-bottom: 7rem;">
            <div class="left-wrapper">

                <div class="user_details">

                    <div class="container">
                        <div class="heading">
                            continue with your details
                        </div>
                        <hr>
                        <form id="process-order-single-form">
                            <input type="hidden" name="single" id="single">
                            <div class="col">
                                <input type="text" value="<?php echo $res['full_name']; ?>" required readonly class="input_box" placeholder="* enter full name" name="name" id="name">
                                <p class="err" id="err_name"></p>
                            </div>

                            <div class="col">
                                <input type="email" value="<?php echo $res['email']; ?>" required readonly class="input_box" placeholder="* email" name="email" id="email">
                                <p class="err" id="err_email"></p>
                            </div>

                            <div class="col">
                                <input type="number" value="<?php echo $res['phone_number']; ?>" required readonly class="input_box" placeholder="* mobile number" name="mobile" id="mobile">
                                <p class="err" id="err_mobile"></p>
                            </div>

                            <div class="col">
                                <input type="number" value="" required class="input_box" placeholder="* pincode " name="pincode" id="pincode">
                                <p class="err" id="err_pincode"></p>
                            </div>

                            <div class="col">
                                <textarea name="address" required class="input_box rounded-lg" placeholder="* address" id="address" cols="30" rows="3"><?php echo $res['address']; ?></textarea>
                                <p class="err" id="err_add"></p>
                            </div>

                            <div class="col">
                                <div class="input_box payment_method_field">
                                    <label class="m-0">sub total :</label>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <p class="m-0"><?php echo $total_price; ?></p>
                                </div>
                                <p class="err" id="err_pincode"></p>
                            </div>

                            <div class="col">
                                <div class="input_box payment_method_field">
                                    <label class="m-0">payment methd :</label>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="checkbox" required name="payment_method" value="cod" id="cod" class="m-0">
                                    &nbsp;&nbsp;
                                    <b><label for="cod" class="m-0">COD</label></b>
                                </div>
                                <p class="err" id="err_pincode"></p>
                            </div>

                            <div class="btn-wrepper">
                                <input type="submit" class="btn btn-dark input_box m-auto text-capitalize py-2" value="place order" name="place_order" id="place_order_btn-single">
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="right-wrapper">
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
                    if (isset($_SESSION['single_product'])) {

                        $ob->select("products_tbl", "name,discription,color,dis_price,image", null, "pro_id=" . $_SESSION['single_product']['pro_id']);

                        $res = $ob->getResult();
                        $res = $res[0];
                        $total_price += $res['dis_price'] * $_SESSION['single_product']['qty'];

                    ?>
                        <form method="POST">
                            <li class="cart_iteam">
                                <div class="cart_img">
                                    <img src="assets\img\products\<?php echo $res['image']; ?>" alt="">
                                </div>
                                <div class="pro_detail">
                                    <div class="pro_name"><?php echo $res['name']; ?></div>
                                    <div class="pro_desc"><?php echo $res['discription'] ?></div>
                                    <div class="pro_size_color"><span class="text-uppercase"><?php echo $sizeArr[$_SESSION['single_product']['size']] . "</span> / <span> " . $res['color'] ?></span></div>
                                </div>
                                <div class="pro_price">
                                    rs. <?php echo $res['dis_price'] ?>
                                </div>
                                <div class="pro_qty">
                                    <div class="pro_qty_control py-2 px-3">
                                        <p><?php echo $_SESSION['single_product']['qty']; ?></p>
                                    </div>
                                </div>
                                <div class="pro_total">
                                    rs. <?php echo $res['dis_price'] * $_SESSION['single_product']['qty']; ?>
                                </div>
                            </li>
                        </form>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <?php require "footer.php"; ?>
    </body>

    </html>

<?php
} ?>