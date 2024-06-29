<?php 

error_reporting(0);

require 'database.php';
require 'config.php';

$ob = new Database();

if (isset($_POST['id']) && $_POST['id'] != "") {
    $id = $_POST['id'];
    $ob->sql("SELECT * FROM sub_category_tbl WHERE cate_id = {$id}");
    $subCate = $ob->getResult();
    
    if(isset($_POST['subId']) && $_POST['subId'] != ""){
        $subId = $_POST['subId'];

        $subCateHtml = "";
        
        foreach ($subCate[0] as $key) {
            if($subId == $key['sub_cate_id']){
                $subCateHtml .= "<option selected value='{$key['sub_cate_id']}'>{$key['sub_cate_name']}</option>";
            }
            else{
                $subCateHtml .= "<option value='{$key['sub_cate_id']}'>{$key['sub_cate_name']}</option>";
            }
        }
    }

    else{

        $subCateHtml = "<option value='' selected hidden>sub category</option>";
        
        foreach ($subCate[0] as $key) {
            $subCateHtml .= "<option value='{$key['sub_cate_id']}'>{$key['sub_cate_name']}</option>";
        }

    }
    
    echo $subCateHtml;
}

?>