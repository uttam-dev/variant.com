<?php
$conn = new mysqli("localhost", "root", "", "variant_db");

$hostname = "localhost";

define("SITE_PATH", "http://" . $hostname . "/Variant.com/");
define("SITE_PATH_ADMIN", "http://" . $hostname . "/Variant.com/admin");

define("SERVER_PATH", $_SERVER['DOCUMENT_ROOT'] . "Variant.com/");

define("CATEGORY_IMG_PATH", "assets/img/product_catagory/");
define("CATEGORY_IMG_SERVER_PATH", SERVER_PATH . CATEGORY_IMG_PATH);
define("CATEGORY_IMG_SITE_PATH", SITE_PATH . CATEGORY_IMG_PATH);

define("PRODUCT_IMG_PATH", "assets/img/products/");
define("PRODUCT_IMG_SERVER_PATH", SERVER_PATH . PRODUCT_IMG_PATH);
define("PRODUCT_IMG_SITE_PATH", SITE_PATH . PRODUCT_IMG_PATH);
