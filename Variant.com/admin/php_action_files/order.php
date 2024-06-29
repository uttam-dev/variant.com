<?php
error_reporting(0);

require 'database.php';
require 'config.php';

$ob = new Database();


// ******************************************
// SEARCH ORDER AND SHOW IN TABLE
// ******************************************


if (isset($_POST['input'])) {
    $input = mysqli_escape_string($conn, $_POST['input']);
    

    if ($input == "*" || $input == "") {
        $ob->sql("SELECT o.order_id,user_id, pro_id, qty, total_price, address, pincode, delivery_status, confirm_status, order_date, payment_status
        FROM `order_tbl` o
        INNER JOIN payment_tbl p ON o.order_id = p.order_id");

        $res = $ob->getResult();
        
    } else {
        $ob->sql("SELECT o.order_id,user_id, pro_id, qty, total_price, `address`, pincode, delivery_status, confirm_status, order_date, payment_status
        FROM `order_tbl` o
        INNER JOIN payment_tbl p ON o.order_id = p.order_id
        WHERE o.order_id LIKE '%{$input}%' OR o.user_id LIKE '%{$input}%'  OR o.address LIKE '%{$input}%' OR pincode LIKE '%{$input}%'");
        $res = $ob->getResult();
    }


    if (count($res[0]) > 0) {

        foreach ($res[0] as $row) {

            $total_qty =array_sum(explode(",",$row['qty']));


            // CONFIRM STATUS
            if ($row['payment_status'] == 1 &&   $row['delivery_status'] == 1) {
                $confirm_status = "<a class='btn btn-outline-succsess disabled' href='#'>confirmed</a>";
            } 
           else if ($row['confirm_status'] == 1) {
                $confirm_status = "<a class='btn btn-success' href='?type=status&operation=confirmed&order_id={$row['order_id']}'>confirmed</a>";
            } else {
                $confirm_status = "<a class='btn btn-outline-danger ' href='?type=status&operation=cancelled&order_id={$row['order_id']}'>cancelled</a>";
            }


            // PAYMENT STATUS
            if($row['confirm_status']==0){
                $pay_status = "<a class='btn btn-outline-info disabled' href='#' >cancelled</a>";
            }
            else if($row['payment_status']==0){
                $pay_status = "<a class='btn btn-outline-warning' href='?type=status&operation=paid&order_id={$row['order_id']}' >pending..</a>";
            }
            else{
                $pay_status = "<a class='btn btn-success' href='?type=status&operation=pending&order_id={$row['order_id']}'>paid</a>";
            }
            

            // DELIVERY STATUS
            if ($row['confirm_status'] == 0) {
                $delivery_status = "<a class='btn btn-outline-info disabled' href='#'>canselled</a>";
            }
            else if ($row['delivery_status'] == 0) {
                $delivery_status = "<a class='btn btn-info' href='?type=status&operation=delivered&order_id={$row['order_id']}'>complete</a>";
            } else {
                $delivery_status = "<a class='btn btn-outline-success' href='?type=status&operation=complate&order_id={$row['order_id']}'>delivered</a>";
            }


           $order_date =explode(" ",date("d-M-Y g:i:s:a", strtotime($row['order_date'])));

            echo
                " <tr>
            <td>
            {$row['order_id']}
            </td>
            <td>
            {$row['user_id']} 
            </td>
            <td>
            {$total_qty} 
            </td>
            <td>
            {$row['total_price']} 
            </td>
            <td>
            {$row['address']} 
            </td>
            <td>
            {$row['pincode']} 
            </td>
            <td>
            {$order_date[0]}<br>{$order_date[1]} 
            </td>
            <td>
            {$pay_status} 
            </td>
            <td>
            {$delivery_status} 
            </td>
            <td>
            {$confirm_status} 
            </td>
            <td>
            <a href='order-detail.php?order_id={$row['order_id']}' class='btn'><i class='fa-solid fa-eye' style='font-size:1.1rem;'></i></a>
            </td>
            </tr>
            ";
        }
    
    } else {
        echo "<tr>
        <td style='color:red; font-size:1.4rem;' class='text-center' colspan='14'>
        order not found !!
        </td>
        </tr>";
    }
}



?>