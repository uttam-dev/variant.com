<?php

error_reporting(0);
require 'database.php';
require 'config.php';

$ob = new Database();
$img_path = "";

// ***************************************
// SEARCH AND SHOW DATA IN TABLE
// ***************************************
if (isset($_POST['input'])) {

    $input = mysqli_escape_string($conn, $_POST['input']);

    if ($input == "*") {
        $ob->sql("SELECT * FROM category_tbl");
        $res = $ob->getResult();
    } else {

        $ob->sql("SELECT * FROM category_tbl WHERE cate_id LIKE '%{$input}%' OR cate_name LIKE '%{$input}%'");
        $res = $ob->getResult();
    }

    if (count($res[0]) > 0) {

        foreach ($res[0] as $row) {

            if ($row['status'] == 1) {
                $status = "<a class='btn btn-success' href='?type=status&operation=deactive&cate_id={$row['cate_id']}'>active</a>";
            } else {
                $status = "<a class='btn btn-danger' href='?type=status&operation=active&cate_id={$row['cate_id']}'>deactive</a>";
            }

            echo
                " <tr>
<td class='font_ss td'>
 {$row['cate_id']}
</td>
<td><img src='" . CATEGORY_IMG_SITE_PATH . $row['image'] . "'></td>
<td>
{$row['cate_name']} 
</td>
<td class='font_ss'>{$status}</td>
<td>
<ul class='d-flex align-items-center justify-content-center'>
    <li><a href='update-cate.php?cate_id={$row['cate_id']}' class='btn'><i
    class='fa-solid fa-pencil'></i></a></li>

    <li><a href='?type=delete&cate_id={$row['cate_id']}' class='btn'><i
    class='fa-solid fa-trash-can'></i></a></li>
    </ul>
    </td>
    </tr>
    ";
        }
    } else {
        echo "<tr>
        <td style='color:red; font-size:1.4rem;' class='text-center' colspan='14'>
        category not found !
        </td>
        </tr>";
    }
}


// ******************************************
// PRODUCTS INSERT
// ******************************************

if (isset($_POST['insert'])) {
    $cate_name = strtolower(trim(mysqli_escape_string($conn, $_POST['cate_name'])));

    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
        $filename = $_FILES['image']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $validExtension = array("jpg", "jpeg", "png", "gif");

        $img_path = "";
        if (in_array($extension, $validExtension)) {
            $newImgName = $cate_name . "-" . rand() . "." . $extension;
            $img_path = CATEGORY_IMG_SERVER_PATH . $newImgName;
        } else {
            echo "this file or extension are not allowed. select only jpg,jpeg,png,gif !!";
            return;
        }



        $values = array("cate_name" => $cate_name, "image" => $newImgName, "status" => 1);

        foreach ($values as $key) {
            if (empty($key)) {
                echo "all field are mandatory to fill up !!";
                return;
            }
        }

        $ob->insert("category_tbl", $values);
        $result = $ob->getResult();
        if ($result[0] == 1) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $img_path)) {
                echo 1;
            }
        } else {
            echo $result[0];
        }
    } else {
        echo "please select category image !! ";
    }
}


// **********************************************
// UPDATE CATEGORY
// ********************************************** 

if(isset($_POST['update'])){     
    
    $cate_id = strtolower(mysqli_escape_string($conn, $_POST['cate_id']));
    $cate_name = strtolower(trim(mysqli_escape_string($conn, $_POST['cate_name'])));



if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {

    $filename = $_FILES['image']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $validExtension = array("jpg", "jpeg", "png", "gif");

    $img_path = "";
    if (in_array($extension, $validExtension)) {
        $newImgName =$cate_name."-". rand() . "." . $extension;
        $img_path = CATEGORY_IMG_SERVER_PATH . $newImgName;
    } else {
        echo "this file or extension are not allowed. select only jpg,jpeg,png,gif !!";
        return;
    }

}

if ($img_path != "") {
    $values = array("cate_name" => $cate_name, "image" => $newImgName);
} else {
    $values = array("cate_name" => $cate_name);
}

foreach ($values as $key) {
    if (empty($key)) {
        echo "all field are mandatory to fill up !!";
        return;
    }
}

$old_img = "";

if ($img_path != "") {
    $ob->sql("SELECT image FROM category_tbl WHERE cate_id=" . $_POST['cate_id']);
    $old_img = $ob->getResult();
    $old_img = $old_img[0][0]["image"];
}

$ob->update("category_tbl", $values, "cate_id=" . $_POST['cate_id']);
$result = $ob->getResult();

if ($result[0] == 1) {
    if (move_uploaded_file($_FILES['image']['tmp_name'], $img_path)) {
        if ($old_img != "") {
            unlink(CATEGORY_IMG_SERVER_PATH . $old_img);
        }
    }
    echo "succsess";
    return;


} else if ($result[0] == 0) {
    echo "not updated!!";
} else {
    echo $result[0];
}

}

?>