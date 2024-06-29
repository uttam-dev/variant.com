<?php

error_reporting(0);

require 'config.php';
require 'database.php';

if (isset($_POST['input'])) {

    $input = mysqli_escape_string($conn, $_POST['input']);
    $ob = new Database();   
    
    if ($input != "" || !empty($input)) {
        $ob->sql("SELECT `name`,`discription` FROM products_tbl WHERE `name` LIKE '%{$input}%' OR `discription` LIKE '%{$input}%'");
        // $ob->sql("SELECT p.name,p.discription,c.cate_name,s.sub_cate_name FROM products p JOIN category c ON p.cate_id = c.cate_id JOIN sub_category s ON p.sub_cate_id = s.sub_cate_id WHERE p.name LIKE '%{$input}%' OR p.discription LIKE '%{$input}%' OR c.cate_name LIKE '%{$input}%' OR s.sub_cate_name LIKE '%{$input}%'");
        $res = $ob->getResult();
        $res =array_unique($res[0]);

    }
    else{
        // $ob->sql("SELECT p.name,c.cate_name,s.sub_cate_name FROM products p JOIN category c JOIN sub_category s LIMIT 7");
        $ob->sql("SELECT p.name
        FROM products_tbl p ORDER BY RAND()
        LIMIT 10;");

        $res = $ob->getResult();     
        // $res = array_unique($res[0]);      
        $res = $res[0];      
    }


    if (count($res) > 0) {
        
        foreach ($res as $key =>$val) {
            foreach ($val as $key_name =>$values) {

                echo " 
                <li><a href=products.php?search=".urlencode(trim($values))."><i class='fa fa-search mr-5'></i>$values</a></li>
                ";
        }
        }
    } else {
        echo "";
    }
}

?>