<?php

error_reporting(0);

require 'php_action_files/config.php';
require 'php_action_files/database.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo ucwords(str_replace(".php","",basename($_SERVER['PHP_SELF'])));?></title>

    <!-- FAVICON LINK -->
    <link rel="shortcut icon" href="../assets\img\web_img\variant_favicon.png" type="image/x-icon">
    <!-- FONT AWSOME CSS (LIBRARY)-->
    <link rel="stylesheet" href="admin_assets\css\all.css">
    <!-- BOOTSTRAP CSS (LIBRARY)-->
    <link rel="stylesheet" href="admin_assets/css/bootstrap.css">
    <!-- UTILITY CLASSES CSS (SELF)-->
    <link rel="stylesheet" href="../assets/css/utility.css">
    <!-- ADMIN SECTION ALL CSS  (SELF)-->
    <link rel="stylesheet" href="admin_assets/css/header.css">
    <!-- LOGIN PAGE CSS  (SELF)-->
    <link rel="stylesheet" href="admin_assets/css/register.css">
    
    <!-- J QUERY JS (LIBRARY)-->
    <script src="../assets/js/jquery.js" type="text/javascript"></script>
    <!-- BOOTSTRAP JS (LIBRARY)-->
    <script src="admin_assets/js/bootstrap.js" type="text/javascript" async></script>
    <!-- FONT AWSOME JS  (LIBRARY)-->
    <script src="admin_assets\js\all.js" type="text/javascript" defer></script>
    <!-- GLOBAL ANIMATION JS (SELF) -->
    <script src="../assets/js/animation.js" type="text/javascript" defer></script>

</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <ul>
                <li class="logo_wrapper">
                    <img src="admin_assets/img/web_img/variant_logo.png" alt="" class="logo">
                </li>
                <li class="admin_details">
                    <div class="admin_dp">
                        <img src="admin_assets/img/web_img/admin-profile.jpg" alt="">
                    </div>
                    <div class="admin_name" data-iteamTarget="admin_name">
                        <p><span>Hi </span><?php 
                        if(isset($_SESSION['ADMIN_LOGIN'])){
                            echo $_SESSION['ADMIN_LOGIN']['username'];
                        }else{
                            echo "Buddy.";
                        }
                      
                        ?>
                        </p>
                        
                        <i class="fa-solid fa-angle-down" data-dropdownContainer="admin_name"></i>

                        <div class="dropdown" data-dropdownContainer="admin_name">
                            <ul>
                                <li><a href="php_action_files\logout.php"><i
                                            class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <header>
        <div class="side_menu " data-dropdownContainer="side_menu">
            <ul>
                <li data-iteamTarget="side_menu">
                    <a href="#" class="menu_wrapper">
                        <i class="menu_icon fa-solid fa-bars"></i>
                        <i class="menu_icon fa-solid fa-xmark"></i>
                    </a>
                </li>
                <li><a href="dashboard.php" <?php if(basename($_SERVER['PHP_SELF']) == "dashboard.php") echo 'class="active"'; ?>><i class="menu_icon fa-solid fa-chart-line"></i>
                        <h5 class="menu_text">DASHBOARD</h5>
                    </a>
                </li>
                <li><a href="products.php" <?php if(basename($_SERVER['PHP_SELF']) == "products.php"  || basename($_SERVER['PHP_SELF']) == "add-product.php"  || basename($_SERVER['PHP_SELF']) == "update-product.php") echo 'class="active"'; ?>><i class="menu_icon fa-solid fa-shirt"></i>
                        <h5 class="menu_text">PRODUCTS</h5>
                    </a>
                </li>
                <li><a href="category.php" <?php if(basename($_SERVER['PHP_SELF']) == "category.php"  || basename($_SERVER['PHP_SELF']) == "update-cate.php") echo 'class="active"'; ?>><i class="menu_icon fa-solid fa-layer-group"></i>
                        <h5 class="menu_text">CATEGORY</h5>
                    </a>
                </li>
                <li>
                    <a href="sub-category.php" <?php if(basename($_SERVER['PHP_SELF']) == "sub-category.php"  || basename($_SERVER['PHP_SELF']) == "update-sub-cate.php") echo 'class="active"'; ?>><i class="menu_icon fa-solid fa-plus-minus"></i>
                        <h5 class="menu_text">SUB-CATEGORY</h5>
                    </a>
                </li>
                <li>
                    <a href="order.php" <?php if(basename($_SERVER['PHP_SELF']) == "order.php"  || basename($_SERVER['PHP_SELF']) == "order-detail.php") echo 'class="active"'; ?>><i class="menu_icon fa-solid fa-arrow-down-up-across-line"></i>
                        <h5 class="menu_text">ORDER</h5>
                    </a>
                </li>
                <li>
                    <a href="payment.php" <?php if(basename($_SERVER['PHP_SELF']) == "payment.php"  || basename($_SERVER['PHP_SELF']) == "payment.php") echo 'class="active"'; ?>><i class="menu_icon fa-solid fa-indian-rupee-sign"></i>
                        <h5 class="menu_text">PAYMENT</h5>
                    </a>
                </li>
                <li>
                    <a href="users.php" <?php if(basename($_SERVER['PHP_SELF']) == "users.php") echo "class='active'";?>><i class="menu_icon fa-solid fa-users"></i>
                        <h5 class="menu_text">USERS</h5>
                    </a>
                </li>
                <li>
                    <a href="feedback.php" <?php if(basename($_SERVER['PHP_SELF']) == "feedback.php") echo "class='active'";?>><i class="menu_icon fa-solid fa-comments"></i>
                        <h5 class="menu_text">FEEDBACK</h5>
                    </a>
                </li>
            </ul>
        </div>