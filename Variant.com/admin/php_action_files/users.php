<?php

error_reporting(0);

require 'database.php';
require 'config.php';

$ob = new Database();

// ***************************************
// SEARCH AND SHOW DATA IN TABLE
// ***************************************
if (isset($_POST['input'])) {

    $input = mysqli_escape_string($conn, $_POST['input']);

    if ($input == " " || empty($input)) {
        $ob->sql("SELECT * FROM user_tbl");
        $res = $ob->getResult();
    } else {
        
        $ob->sql("SELECT * FROM user_tbl WHERE user_id LIKE '%{$input}%' OR  email LIKE '%{$input}%' OR full_name LIKE '%{$input}%' ");
        $res = $ob->getResult();
        print_r($res);
    }


    if (count($res[0]) > 0) {

        foreach ($res[0] as $row) {

            if ($row['active_status'] == 1) {
                $status = "<a class='btn btn-info' href='?type=status&operation=blocked&user_id={$row['user_id']}'>active</a>";
            } else {
                $status = "<a class='btn btn-danger' href='?type=status&operation=active&user_id={$row['user_id']}'>blocked</a>";
            }

            $reg_date = explode(" ",date("d-M-Y g:i:s:a", strtotime($row['reg_date'])));

            echo
                " <tr>
<td>
 {$row['user_id']}
</td>
<td>
{$row['full_name']} 
</td>
<td class='text-lowercase'>
{$row['email']} 
</td>
<td>
{$row['phone_number']} 
</td>
<td>
{$reg_date[0]} <br>
{$reg_date[1]} 
</td>
<td>{$status}</td>
<td>
    <a href='?type=delete&user_id={$row['user_id']}' class='btn'><i
    class='fa-solid fa-trash-can'></i></a>
</td>
</tr>
    ";
        }
    } else {
        echo "<tr>
        <td style='color:red; font-size:1.4rem;' class='text-center' colspan='14'>
        user not found !
        </td>
        </tr>";
    }
}
?>