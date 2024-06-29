<?php
error_reporting(0);
require "php_files/config.php";
require "php_files/database.php";
session_start();

if (!isset($_SESSION['LOGIN'])) {
    header("location:login.php");
} else {

    if (isset($_POST['submit'])) {

        $fullName = $_POST['name'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        if (strlen((string)$mobile) > 10 || strlen((string)$mobile) < 10) {
            echo "<script>alert(' Please Enter Valid Mobile Number ')</script>";
        }
        $values = array("full_name" => $fullName, "phone_number" => $mobile, "address" => $address);
        $ob = new Database();
        $ob->update("user_tbl", $values, "email = '{$_SESSION['LOGIN']['email']}'");
        $res = $ob->getResult();

        echo "<script>alert('Profile Update Succsessfully ')</script>";
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile - Varian.com</title>


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
        <link rel="stylesheet" href="assets/css/profile.css">
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
        <style>
            body {
                height: 100vh;
                background-color: #f3f3f3;
                background: url('assets/img/web_img/form-background.png');
                background-position: center;
                object-fit: cover;
            }
        </style>

        <div class="main-wrapper" style="margin-bottom: 5rem;">

            <?php

            $ob = new Database();
            $ob->select("user_tbl", "*", null, "email = '{$_SESSION['LOGIN']['email']}'");
            $res = $ob->getResult();
            $res = $res[0];

            ?>

            <!-- <div class="left-wrapper"> -->
            <div class="user_details">
                <div class="container">
                    <div class="heading">
                        Your Profile
                    </div>
                    <hr>
                    <form id="user_profile" method="POST">

                        <div class="col">
                            <label class="mr-auto font-weight-bold m-0 ml-2">Full Name </label>
                            <input type="text" value="<?php echo $res['full_name']; ?>" required class="input_box mt-1" placeholder="* enter full name" name="name" id="name">
                            <p class="err" id="err_name"></p>
                        </div>

                        <div class="col">
                            <label class="mr-auto font-weight-bold m-0 ml-2">Email</label>
                            <input type="email" value="<?php echo $res['email'] ?>" readonly required class="input_box mt-1" placeholder="* email" name="email" id="email">
                            <p class="err" id="err_email"></p>
                        </div>

                        <div class="col">
                            <label class="mr-auto font-weight-bold m-0 ml-2">Mobile</label>
                            <input type="number" value="<?php echo $res['phone_number'] ?>" required class="input_box mt-1" placeholder="* mobile number" name="mobile" id="mobile">
                            <p class="err" id="err_mobile"></p>
                        </div>

                        <div class="col">
                            <label class="mr-auto font-weight-bold m-0 ml-2">Address</label>
                            <textarea name="address" required class="input_box mt-1 rounded-lg" placeholder="* address" id="address" cols="30" rows="3"><?php echo $res['address'] ?></textarea>
                            <p class="err" id="err_add"></p>
                        </div>

                        <div class="col">
                            <label class="mr-auto font-weight-bold m-0 ml-2">Registration Date</label>
                            <p class="input_box mt-1" id="reg_date"><?php echo date("d-m-Y", strtotime($res['reg_date'])); ?> </p>
                            <p class="err" id="err_reg_date"></p>
                        </div>

                        <div class="btn-wrepper">
                            <input type="submit" class="btn btn-dark input_box m-auto text-capitalize py-2" value="update profile" name="submit" id="submit">
                        </div>

                    </form>
                </div>
            </div>
            <!-- </div> -->

            <div class="vecotor_img">
                <img src="assets\img\web_img\profile-vector.png" alt="" class="mb-5">
            </div>

        </div>
        <?php require "footer.php"; ?>

    </body>

    </html>

<?php }
?>