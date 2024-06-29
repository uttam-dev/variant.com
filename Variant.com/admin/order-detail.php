<?php
require 'header.php';

if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}

$order_id = $_GET['order_id'];
$ob = new Database();

$ob->sql("SELECT `order_id`, o.user_id,`pro_id`,`sizes`,`qty`,`total_price`,o.address,`pincode`,`order_date`,u.full_name FROM `order_tbl` o 
INNER JOIN user_tbl u ON o.user_id=u.user_id
WHERE order_id =" . $order_id);

$res = $ob->getResult();
$res = $res[0][0];

$order_date = explode(" ", date("d-M-Y g:i:s:a", strtotime($res['order_date'])));

$pro_query = array();
foreach (explode(",", $res['pro_id']) as $val) {
    array_push($pro_query, "pro_id = " . $val);
}


// FOR PRODUCTS 
$pro_query = implode(" OR ", $pro_query);
$ob->sql("SELECT pro_id,name,dis_price,discription,image FROM products_tbl WHERE " . $pro_query);
$pro_data = $ob->getResult();
$pro_data = $pro_data[0];

// SIZE
$sizeArr = array("1" => "s", "2" => "m", "3" => "l", "4" => "xl", "5" => "xxl", "6" => "xxxl");

$size = explode(",", $res['sizes']);
$sizes = array();
$sizeLen = count($size);
for ($i = 0; $i < $sizeLen; $i++) {
    $sizes[$i] = $sizeArr[$size[$i]];
}

// QUANTITY 
$pro_qty = explode(",", $res['qty']);

?>
<section id="orders-detail" class="main_content form_bg">
    <div class="heading text_underline  ">
        order detail
    </div>
    <div class="content_wrapper mt-5 mx-auto px-5 row container text-capitalize">
        <div class="col-6 my-3">
            <label for="order_id" class="form-label">order id</label>
            <input readonly id="order_id" type="text" class="form-control" value="<?php echo $res['order_id'] ?>">
        </div>
        <div class="col-6 my-3">
            <label for="user_id" class="form-label">user id</label>
            <input readonly id="user_id" type="text" class="form-control" value="<?php echo $res['user_id'] ?>">
        </div>

        <div class="col-12 my-3">
            <label for="order_id" class="form-label">user full name</label>
            <input readonly type="text" class="form-control text-capitalize " value="<?php echo $res['full_name'] ?>">
        </div>
        <div class="col-12 my-3">
            <label for="order_id" class="form-label">address</label>
            <textarea readonly type="text" class="form-control text-capitalize "><?php echo $res['address'] ?></textarea>
        </div>
        <div class="col-6 my-3">
            <label for="order_id" class="form-label">pincode</label>
            <input readonly type="text" class="form-control" value="<?php echo $res['pincode'] ?>">
        </div>
        <div class="col-6 my-3">
            <label for="order_id" class="form-label">order date</label>
            <input readonly type="text" class="form-control"
                value='<?php echo $order_date[0] . "  " . $order_date[1]; ?>'>
        </div>
        <div class="col-12 my-3">products detail</div>
        <div class="col-12">

            <?php
            $pro_len = count($pro_data);

            $total_order_price=0;
           $total_qty =0;
            
            for ($i = 0; $i < $pro_len; $i++) {
                $pro_total = $pro_qty[$i] * $pro_data[$i]['dis_price'];

                $total_order_price+=$pro_total;
                $total_qty+=$pro_qty[$i];
                echo "
                    <div class='cart row'>
                <div class='col-2 img_area'>
                    <img src=" . PRODUCT_IMG_SITE_PATH . $pro_data[$i]['image'] . " alt=''>
                </div>
                <div class='col text_aria row'>
                    <div class='col-6 cart_left'>
                        <div class='pro_id'>id : {$pro_data[$i]['pro_id']}</div>
                        <div class='pro_name'>name : {$pro_data[$i]['name']}</div>
                        <div class='pro_desc'>description : {$pro_data[$i]['discription']}</div>
                        <div class='pro_size'>size : {$sizes[$i]}</div>
                    </div>
                    <div class='col-6 cart_right'>
                        <div class='pro_qty'>product quantity : {$pro_qty[$i]} </div>
                        <div class='pro_price'>product price : {$pro_data[$i]['dis_price']} </div>
                        <div class='pro_total_price'>product total price : {$pro_total}</div>
                    </div>
                </div>
            </div>";
            }
            ?>
        </div>
        <div class="col total_price_area">
            <h5>total quantity : <?php echo $total_qty;?></h5>
            <h5>total price : <?php echo $total_order_price;?></h5>
        </div>
    </div>
</section>
</header>
<?php
require 'footer.php';
?>
</body>

</html>