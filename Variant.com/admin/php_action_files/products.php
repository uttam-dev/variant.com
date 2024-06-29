<?php

error_reporting(0);

require 'database.php';
require 'config.php';


$img_path = "";
// *************************************
// SEARCH AND SHOW TABLE FOR PRODUCTS
// *************************************
if (isset($_POST['input'])) {

    $input = mysqli_escape_string($conn, $_POST['input']);
    $ob = new Database();
    $rea = "";
    if ($input == "*" || empty($input)) {
        $ob->sql("SELECT * FROM products_tbl");
        $res = $ob->getResult();
    } else {

        $ob->sql("SELECT * FROM products_tbl WHERE pro_id LIKE '%{$input}%' OR name LIKE '%{$input}%' OR discription LIKE '%{$input}%'");
        $res = $ob->getResult();
    }
    $sizeArr = array("1" => "s", "2" => "m", "3" => "l", "4" => "xl", "5" => "xxl", "6" => "xxxl");

    if (count($res[0]) > 0) {

        foreach ($res[0] as $row) {

            $size = explode(",", $row["size"]);

            $newSizeArr = array();
            $sizeLen = count($size);

            for ($i = 0; $i < $sizeLen; $i++) {
                array_push($newSizeArr, $sizeArr[$size[$i]]);
            }

            $size = implode(",", $newSizeArr);

            if ($row['status'] == 1) {
                $status = "<a class='btn btn-success status' href='?type=status&operation=deactive&pro_id={$row['pro_id']}'>active</a>";
            } else {
                $status = "<a class='btn btn-danger status' href='?type=status&operation=active&pro_id={$row['pro_id']}'>deactive</a>";
            }

            echo
            " <tr>
        <td class='px-0'>
             {$row['pro_id']}
        </td>
        <td><img src='" . PRODUCT_IMG_SITE_PATH . $row['image'] . "'></td>
        <td>
        {$row['name']} 
        </td>
        <td>
             {$row['cate_id']} 
        </td>
        <td>
        {$row['sub_cate_id']} 
        </td>
        <td class='text-uppercase'>
        {$size}
        </td>
        <td>
        {$row['color']}
        </td>
        <td>
        {$row['org_price']} 
        </td>
        <td>
        {$row['dis_price']} 
        </td>
        <td>
        {$row['discount']} %
        </td>
        <td> {$row['discription']}
        </td>
        <td>
        {$row['stock']}
        </td>
        <td>{$status}</td>
        <td>
            <ul class='d-flex align-items-center'>
                <li><a href='update-product.php?pro_id={$row['pro_id']}' class='btn'><i
                class='fa-solid fa-pencil'></i></a></li>

                <li><a href='?type=delete&pro_id={$row['pro_id']}' class='btn'><i
                class='fa-solid fa-trash-can'></i></a></li>
                </ul>
                </td>
                </tr>
                ";
        }
    } else {
        echo "<tr>
        <td style='color:red; font-size:1.4rem;' class='text-center' colspan='14'>
        products not found !
        </td>
        </tr>";
    }
}


// *************************************
// PRODUCTS INSERT
// *************************************

if (isset($_POST['insert'])) {
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $filename = $_FILES['image']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $validExtension = array("jpg", "jpeg", "png", "gif", "webp","avif");

        $img_path = "";
        if (in_array($extension, $validExtension)) {
            $newImgName = rand() . "." . $extension;
            $img_path = PRODUCT_IMG_SERVER_PATH . $newImgName;
        } else {
            echo "this file or extension are not allowed. select only jpg,jpeg,png,gif !!";
            return;
        }

        $name = strtolower(mysqli_escape_string($conn, $_POST['name']));
        $disc = strtolower(mysqli_escape_string($conn, $_POST['discription']));
        $cate = mysqli_escape_string($conn, $_POST['cate']);
        $sub_cate = mysqli_escape_string($conn, $_POST['sub_cate']);
        $org_price = mysqli_escape_string($conn, $_POST['org_price']);
        $dis_price = mysqli_escape_string($conn, $_POST['dis_price']);
        $discount = mysqli_escape_string($conn, $_POST['discount']);
        $color = strtolower(mysqli_escape_string($conn, $_POST['color']));
        $stock = mysqli_escape_string($conn, $_POST['stock']);

        if (isset($_POST['size'])) {
            $size = implode(",", $_POST['size']);
        } else {
            echo "size's are not selected !! ";
            return;
        }

        $values = array("name" => $name, "cate_id" => $cate, "sub_cate_id" => $sub_cate, "org_price" => $org_price, "dis_price" => $dis_price, "discount" => $discount, "size" => $size, "color" => $color, "stock" => $stock, "discription" => $disc, "image" => $newImgName, "status" => 1);

        foreach ($values as $key) {
            if ($key == " ") {
                echo "all field are mandatory to fill up !!";
                return;
            }
        }
        $ob = new Database();
        $ob->insert("products_tbl", $values);
        $result = $ob->getResult();
        if ($result[0] == 1) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $img_path)) {
                echo 1;
            }
        } else {
            echo $result[0];
        }
    } else {
        echo "please select product image !! ";
    }
}



// *************************************
// PRODUCTS UPDATE
// *************************************
if (isset($_POST['update'])) {
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {

        $filename = $_FILES['image']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $validExtension = array("jpg", "jpeg", "png", "gif", "webp","avif");

        $img_path = "";
        if (in_array($extension, $validExtension)) {
            $newImgName = rand() . "." . $extension;
            $img_path = PRODUCT_IMG_SERVER_PATH . $newImgName;
        } else {
            echo "this file or extension are not allowed. select only jpg , jpeg , png , gif !!";
            return;
        }
    }

    $name = strtolower(trim(mysqli_escape_string($conn, $_POST['name'])));
    $disc = strtolower(trim(mysqli_escape_string($conn, $_POST['discription'])));
    $cate = trim(mysqli_escape_string($conn, $_POST['cate']));
    $sub_cate = trim(mysqli_escape_string($conn, $_POST['sub_cate']));
    $org_price = trim(mysqli_escape_string($conn, $_POST['org_price']));
    $dis_price = trim(mysqli_escape_string($conn, $_POST['dis_price']));
    $discount = trim(mysqli_escape_string($conn, $_POST['discount']));
    $color = strtolower(trim(mysqli_escape_string($conn, $_POST['color'])));
    $stock = trim(mysqli_escape_string($conn, $_POST['stock']));

    if (isset($_POST['size'])) {
        $size = implode(",", $_POST['size']);
    } else {
        echo "size's are not selected !! ";
        return;
    }
    if (!empty($img_path)) {
        $values = array("name" => $name, "cate_id" => $cate, "sub_cate_id" => $sub_cate, "org_price" => $org_price, "dis_price" => $dis_price, "discount" => $discount, "size" => $size, "color" => $color, "stock" => $stock, "discription" => $disc, "image" => $newImgName, "status" => 1);
    } else {
        $values = array("name" => $name, "cate_id" => $cate, "sub_cate_id" => $sub_cate, "org_price" => $org_price, "dis_price" => $dis_price, "discount" => $discount, "size" => $size, "color" => $color, "stock" => $stock, "discription" => $disc, "status" => 1);
    }

    foreach ($values as $key) {
        if (empty($key)) {
            echo "all field are mandatory to fill up !!";
            return;
        }
    }
    $ob = new Database();
    $old_img = "";
    if (!empty($img_path)) {
        $ob->sql("SELECT image FROM products_tbl WHERE pro_id=" . $_POST['pro_id']);
        $old_img = $ob->getResult();
        $old_img = $old_img[0][0]["image"];
    }

    $ob->update("products_tbl", $values, "pro_id=" . $_POST['pro_id']);
    $result = $ob->getResult();

    if ($result[0] == 1) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $img_path)) {
            if ($old_img != "") {
                unlink(PRODUCT_IMG_SERVER_PATH . $old_img);
            }
        }
        echo "<script> window.location.href='./products.php'</script>";
    } else if ($result[0] == 0) {
        echo "not updated!!";
    } else {
        echo $result[0];
    }
}
