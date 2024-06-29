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
        $ob->sql("SELECT * FROM feedback_tbl");
        $res = $ob->getResult();
    } else {

        $ob->sql("SELECT * FROM feedback_tbl WHERE feed_id LIKE '%{$input}%' OR email LIKE '%{$input}%' OR massage LIKE '%{$input}%' ");
        $res = $ob->getResult();
    }

    if (count($res[0]) > 0) {

        foreach ($res[0] as $row) {

            $time = explode(" ", date("d-M-Y g:i:s:a", strtotime($row['time'])));

            echo
            "
            <tr>
<td name='feed_id'>
 {$row['feed_id']}
</td>
<td class='text-lowercase'>
{$row['email']} 
</td>
<td style='max-width:20vw;'>
{$row['massage']} 
</td>
<td>
$time[0]<br> 
$time[1] 
</td>
<td>
    <a href='?type=delete&feed_id={$row['feed_id']}' name='delete' class='btn'><i
    class='fa-solid fa-trash-can'></i></button>
</td>
</tr>
";
        }
    } else {
        echo "<tr>
        <td style='color:red; font-size:1.4rem;' class='text-center' colspan='14'>
        feedback not found !
        </td>
        </tr>";
    }
}
