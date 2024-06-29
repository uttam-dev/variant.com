<?php
$conn = new mysqli("localhost", "root", "", "variant_db");

$hostname = "localhost";

define("SITE_PATH", "http://" . $hostname . "/Variant.com/");
define("SITE_PATH_ADMIN", "http://" . $hostname . "/Variant.com/admin");
