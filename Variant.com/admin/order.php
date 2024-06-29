<?php require 'header.php';

if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}


if (
    isset($_GET['type']) && $_GET['type'] != ""
    && isset($_GET['order_id']) && $_GET['order_id'] != ""
    ) {
 
    $type = mysqli_escape_string($conn, $_GET['type']);
    $order_id = mysqli_escape_string($conn, $_GET['order_id']);

    $ob = new Database();

    if ($type == "status") {
        if (isset($_GET['operation']) && $_GET['operation'] != "") {
            if ($_GET['operation'] == "delivered") {
                $ob->sql("UPDATE `order_tbl` SET delivery_status = 1 WHERE order_id = " . $order_id);
            } else if ($_GET['operation'] == "complate") {
                $ob->sql("UPDATE `order_tbl` SET delivery_status = 0 WHERE order_id = " . $order_id);
            }

            if ($_GET['operation'] == "paid") {
                $ob->sql("UPDATE `payment_tbl` SET payment_status = 1 WHERE order_id = " . $order_id);
            } else if ($_GET['operation'] == "pending") {
                $ob->sql("UPDATE `payment_tbl` SET payment_status = 0 WHERE order_id = " . $order_id);
            }

            if ($_GET['operation'] == "cancelled") {
                $ob->sql("UPDATE `order_tbl` SET confirm_status = 1 WHERE order_id = " . $order_id);
            } else if ($_GET['operation'] == "confirmed") {
                $ob->sql("UPDATE `order_tbl` SET confirm_status = 0 WHERE order_id = " . $order_id);
            }
        }
    }
}
?>

<section id="orders" class="main_content">
    <div class="heading text_underline  ">
        all orders
    </div>

        <div class="d-flex justify-content-end container">
            <input id="search_input" type="text" class="form-control d-inline w-25" placeholder="search order">
            <button id="search_btn" class="btn btn-dark d-inline ml-3">search</button>
        </div>

    <div class="content_wrapper mt-5">
        <table class="table table-striped table-hover text-capitalize">
            <thead class="thead-dark text-capitalize">
                <tr>
                    <th>order id</th>
                    <th>user id</th>
                    <th>quntity</th>
                    <th>total price</th>
                    <th>address</th>
                    <th>pincode</th>
                    <th>order date</th>
                    <th>payment status</th>
                    <th>dilivery</th>
                    <th>confirm</th>
                    <th>view</th>
                </tr>
            </thead>
            <tbody id="table_data">

            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {

            let search_input = $("#search_input");

            searchData("*");

            search_input.keyup(function () {
                searchData($(this).val().trim().toLowerCase())
            })

            $("#search_btn").on("click", function () {
                searchData($("#search_input").val().trim().toLowerCase());
            })

            function searchData(input) {
                if (input != " ") {
                    $.ajax({
                        url: "php_action_files/order.php",
                        type: 'POST',
                        data: { input: input },
                        success: function (result) {
                            $("#table_data").html(result);
                        },
                    })
                }
            }
        })
    </script>

</section>
</header>

<?php
require 'footer.php';
?>
</body>

</html>