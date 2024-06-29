<?php require 'header.php';
$ob = new Database();

if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}
?>

<section id="dashboard" class="main_content">
    <div class="heading text_underline">
        dashboard
    </div>
    <div class="cards_wrapper">
        <div class="card">
            <?php
            $ob = new Database();
            $ob->select('products_tbl', 'COUNT(pro_id) AS pro_count', null, null, null, 0);
            $res = $ob->getResult();
            ?>
            <i class="card_icon fa-solid fa-chart-line"></i>
            <div class="card_content">
                <div class="card_title">Products</div>
                <div class="card_details">
                    <?php echo $res[0]['pro_count']; ?>
                </div>
                <div class="card_sub_details"></div>
            </div>
        </div>
        <div class="card">
            <?php
            $ob = new Database();
            $ob->select('category_tbl', 'COUNT(cate_id) AS cate_count', null, null, null, 0);
            $res = $ob->getResult();
            ?>
            <i class="card_icon fa-solid fa-table-list"></i>
            <div class="card_content">
                <div class="card_title">category</div>
                <div class="card_details">
                    <?php echo $res[0]['cate_count']; ?>
                </div>
                <div class="card_sub_details"></div>
            </div>
        </div>
        <div class="card">
            <?php
            $ob = new Database();
            $ob->select('sub_category_tbl', 'COUNT(sub_cate_id) AS sub_cate_count', null, null, null, 0);
            $res = $ob->getResult();
            ?>
            <i class="card_icon fa-solid fa-plus-minus"></i>
            <div class="card_content">
                <div class="card_title">sub-category</div>
                <div class="card_details">
                    <?php echo $res[0]['sub_cate_count']; ?>
                </div>
                <div class="card_sub_details"></div>
            </div>
        </div>
        <div class="card">
            <?php
            $ob = new Database();
            $ob->sql("SELECT COUNT(order_id) as order_count FROM `order_tbl`");
            $res = $ob->getResult();
            
            ?>
            <i class="card_icon fa-solid fa-arrow-down-up-across-line"></i>
            <div class="card_content">
                <div class="card_title">order</div>
                <div class="card_details"><?php echo $res[0][0]['order_count']; ?></div>
                <div class="card_sub_details"></div>
            </div>
        </div>
        <div class="card">
            
            <?php
                $ob = new Database();
                $ob->select('user_tbl', 'COUNT(user_id) AS user_count', null, null, null, 0);
                $res = $ob->getResult();
            ?>

            <i class="card_icon fa-solid fa-users"></i>
            <div class="card_content">
                <div class="card_title">users</div>
                <div class="card_details">
                    <?php echo $res[0]['user_count']; ?>
                </div>
                <div class="card_sub_details"></div>
            </div>
        </div>
        <div class="card">

        <?php
                $ob = new Database();
                $ob->sql("SELECT * FROM `order_tbl` WHERE DATE(order_date) = CURDATE() AND TIME(order_date)>'00:00:00'");
                $res = $ob->getResult();

                $total=0;
                foreach($res[0] as $order){
                    $total += ($order["qty"] * $order["total_price"]);
                }
            ?>

            <i class="card_icon fa-solid fa-chart-line"></i>
            <div class="card_content">
                <div class="card_title">sales</div>
                <div class="card_details"><?php echo $total; ?></div>
                <div class="card_sub_details">last <?php echo date("G");?>  hours</div>
            </div>
        </div>
    </div>


    <div class="container-fluid text-capitalize py-5">
        <table class="table table-striped my-3">
            <thead>
                <tr>
                    <th scope="col" colspan="4">
                        <h4 class="text_underline">Out Of Stock</h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ob = new Database(); 
                $ob->select("products_tbl","pro_id,name",null,"stock=0");
                $res = $ob->getResult();
                foreach($res as $row){
                echo "<tr>
                    <th scope='row'>Product Id :</th>
                    <th class='font_ss'> {$row['pro_id']} </th>
                    <th>Product Name :</th>
                    <th class='font_ss'> {$row['name']} </th>
                </tr>";  
                }
                ?>
            </tbody>
        </table>
    </div>

</section>
</header>
<?php
require 'footer.php';
?>
</body>

</html>