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
    <title>Register Now - Variant.com</title>


    <!-- BOOTSTRAP CSS (LIBRARY) -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!-- UTILITY CSS CLASESS (SELF)-->
    <link rel="stylesheet" href="assets/css/utility.css">
    <!-- GOLABAL NAV CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/header.css">
    <!-- FOOTER  CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- REGISTER PAGE CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/register.css">


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

    <style>
        body {
            height: 100vh;
            background: #ebebeb;
            background: url('assets/img/web_img/form-background.png');
            background-position: center;
            object-fit: cover;
        }
    </style>
    <div class="main-wrapper">
        <div class="vecotor_img">
            <img src="assets\img\web_img\register-vector.png" alt="">
        </div>
        <div class="login_form text-capitalize">
            <div class="container">
                <div class="heading">
                    register now
                </div>
                
                <hr>

                <form id="register_form">

                    <div class="col">
                        <input type="text" required class="input_box" placeholder="* enter full name" name="name" id="name">
                        <p class="err" id="err_name"></p>
                    </div>
                    <p></p>
                    <div class="col">
                        <input type="email" required class="input_box" placeholder="* email" name="email" id="email">
                        <p class="err" id="err_email"></p>
                    </div>
                    <p></p>
                    <div class="col">
                        <input type="number" required class="input_box" placeholder="* mobile number" name="mobile" id="mobile">
                        <p class="err" id="err_mobile"></p>
                    </div>
                    <p></p>
                    <div class="col">
                        <input type="text" required class="input_box" placeholder="* address" name="address" id="address">
                        <p class="err" id="err_add"></p>
                    </div>
                    <p></p>
                    <div class="col">
                        <input type="password" required class="input_box" placeholder="* password" name="password" id="password">
                        <p class="err" id="err_pass"></p>
                    </div>
                    <div class="col">
                        <input type="password" required class="input_box" placeholder="* confirm password" name="cpassword" id="cpassword">
                        <p class="err" id="err_cpass"></p>
                    </div>
                    <div class="btn-wrepper">
                        <input type="submit" class="btn btn-dark input_box m-auto" value="Submit" name="submit" id="submit">
                    </div>
                    <div class="cta-link">
                        <p>already have an account ? <a href="login.php">login</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="alert alert-success align-items-center w-50 data_info_alert" role="alert">
        <i class="fa-solid fa-circle-check mr-4"></i>
        <div>
            you are register successfully
        </div>
    </div>
</body>

</html>