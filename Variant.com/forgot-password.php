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
    <title>Forgot Password - Variant.com</title>


    <!-- FAVICON LINK -->
    <link rel="shortcut icon" href="assets\img\web_img\variant_favicon.png" type="image/x-icon">

    <!-- BOOTSTRAP CSS (LIBRARY) -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!-- UTILITY CSS CLASESS (SELF)-->
    <link rel="stylesheet" href="assets/css/utility.css">
    <!-- GOLABAL NAV CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/header.css">
    <!-- REGISTER PAGE CSS (SELF)-->
    <link rel="stylesheet" href="assets/css/register.css">
    <!-- FOOTER  CSS (SELF)-->
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

    <style>
        body {
            height: 100vh;
            background-color: #f3f3f3;
            background: url('assets/img/web_img/form-background.png');
            background-position: center;
            object-fit: cover;
        }
    </style>
    <div class="main-wrapper login">
        <div class="vecotor_img">
            <img src="assets\img\web_img\forgot-vector.png" alt="">
        </div>
        <div class="login_form text-capitalize">
            <div class="container">
                <div class="heading">
                    forgot password
                </div>
                <hr>
                <form id="forgot_form">

                    <div class="col">
                        <input type="email" class="input_box" placeholder="* email" id="email" name="email">
                        <p class="err" id="err_email"></p>
                    </div>

                    <div class="col">
                        <input type="password" class="input_box" placeholder="* new password" id="pass" name="pass">
                        <p class="err" id="err_pass"></p>
                    </div>

                    <div class="col">
                        <input type="password" class="input_box" placeholder="* confirm password" id="cpass" name="cpass">
                        <p class="err" id="err_cpass"></p>
                    </div>

                    <div class="col omy-2 ml-2">
                        <a href="login.php" class="cta-link text-info">back to login page..</a>
                    </div>

                    <div class="btn-wrepper">
                        <input type="submit" class="btn btn-dark input_box m-auto" value="Change Password">
                    </div>


                </form>
            </div>
        </div>
    </div>
  
    <div class="alert alert-success align-items-center w-50 data_info_alert data_info_alert-succsess " role="alert">
        <i class="fa-solid fa-circle-check mr-4"></i>
        <div>
            password change successfully
        </div>
    </div>
   
    <div class="alert alert-danger align-items-center w-50 data_info_alert data_info_alert-danger" role="alert">
        <i class="fa-solid fa-circle-xmark mr-4"></i>
        <div>
            password change successfully
        </div>
    </div>
</body>

</html>