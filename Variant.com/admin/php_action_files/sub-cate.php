<?php

error_reporting(0);

require 'database.php';
require 'config.php';

$ob = new Database();


// ******************************************
// SEARCH SUB CATE AND SHOW IN TABLE
// ******************************************
if (isset($_POST['input'])) {
    $input = mysqli_escape_string($conn, $_POST['input']);


    if ($input == "*") {
        $ob->sql("SELECT sub_cate_id, sub_cate_name ,s.status,cate_name FROM sub_category_tbl s INNER JOIN category_tbl c ON s.cate_id = c.cate_id ");
        $res = $ob->getResult();

    } else {
        $ob->sql("SELECT s.sub_cate_id, s.sub_cate_name ,s.status,c.cate_name FROM sub_category_tbl s INNER JOIN category_tbl c ON s.cate_id = c.cate_id 
        WHERE s.sub_cate_id LIKE '%{$input}%' OR s.sub_cate_name LIKE '%{$input}%'  OR c.cate_name LIKE '%{$input}%'");
        $res = $ob->getResult();
    }


    if (count($res[0]) > 0) {

        foreach ($res[0] as $row) {

            if ($row['status'] == 1) {
                $status = "<a class='btn btn-success' href='?type=status&operation=deactive&sub_cate_id={$row['sub_cate_id']}'>active</a>";
            } else {
                $status = "<a class='btn btn-danger' href='?type=status&operation=active&sub_cate_id={$row['sub_cate_id']}'>deactive</a>";
            }

            echo
                " <tr>
            <td>
            {$row['sub_cate_id']}
            </td>
            <td>
            {$row['cate_name']} 
            </td>
            <td>
            {$row['sub_cate_name']} 
            </td>
            <td>{$status}</td>
            <td>
        <ul class='d-flex align-items-center justify-content-center'>
            <li><a href='update-sub-cate.php?sub_cate_id={$row['sub_cate_id']}' class='btn'><i
            class='fa-solid fa-pencil'></i></a></li>

            <li><a href='?type=delete&sub_cate_id={$row['sub_cate_id']}' class='btn'><i
            class='fa-solid fa-trash-can'></i></a></li>
        </ul>
            </td>
            </tr>
            ";
        }
    } else {
        echo "<tr>
        <td style='color:red; font-size:1.4rem;' class='text-center' colspan='14'>
        sub category not found !
        </td>
        </tr>";
    }
}



// *************************************
// SUB CATE INSERT
// *************************************
if (isset($_POST['insert'])) {
    $sub_cate_name = strtolower(trim(mysqli_escape_string($conn, $_POST['sub_cate_name'])));
    $cate_id = strtolower(trim(mysqli_escape_string($conn, $_POST['cate_id'])));


    $values = array("sub_cate_name" => $sub_cate_name, "cate_id" => $cate_id, "status" => 1);

    foreach ($values as $key) {
        if (empty($key)) {
            echo "all field are mandatory to fill up !!";
            return;
        }
    }

    $ob->insert("sub_category_tbl", $values);
    $result = $ob->getResult();
    if ($result[0] == 1) {
        echo 1;
    } else {
        echo $result[0];
    }
}



// ***********************************************
// UPDATE SUB CATE 
// ***********************************************

if (isset($_POST['update'])) {

    $sub_cate_id = strtolower(mysqli_escape_string($conn, $_POST['sub_cate_id']));
    $cate_id = strtolower(mysqli_escape_string($conn, $_POST['cate_id']));
    $sub_cate_name = strtolower(trim(mysqli_escape_string($conn, $_POST['sub_cate_name'])));

    $values = array("sub_cate_name" => $sub_cate_name, "cate_id" => $cate_id);


    foreach ($values as $key) {
        if (empty($key)) {
            echo "all field are mandatory to fill up !!";
            return;
        }
    }

    $ob->update("sub_category_tbl", $values, "sub_cate_id=" . $sub_cate_id);
    $result = $ob->getResult();

    if ($result[0] == 1) {
        echo "succsess";
        return;

    } else if ($result[0] == 0) {
        echo "not updated!!";
    } else {
        echo $result[0];
    }
}

?>