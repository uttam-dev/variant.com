<?php require 'header.php';


if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}


if (
    isset($_GET['type']) && $_GET['type'] != ""
    && isset($_GET['pro_id']) && $_GET['pro_id'] != ""
) {

    $type = mysqli_escape_string($conn, $_GET['type']);
    $pro_id = mysqli_escape_string($conn, $_GET['pro_id']);

    $ob = new Database();

    if ($type == "status") {
        if (isset($_GET['operation']) && $_GET['operation'] != "") {
            if ($_GET['operation'] == "active") {
                $ob->sql("UPDATE products_tbl SET status = 1 WHERE pro_id = " . $pro_id);
            } else if ($_GET['operation'] == "deactive") {
                $ob->sql("UPDATE products_tbl SET status = 0 WHERE pro_id = " . $pro_id);
            }
        }
    }

    if ($type == "delete") {
        $ob->sql("SELECT image FROM products_tbl WHERE pro_id=" . $pro_id);
        $old_img = $ob->getResult();

        $ob->delete("products", "pro_id=" . $pro_id);
        $result = $ob->getResult();

        if ($result[0] == 1) {
            unlink(PRODUCT_IMG_SERVER_PATH . $old_img[0][0]['image']);
            echo "<script> dataAlertBox(1); </script>";
        }
    }
}
?>

<section id="product" class="main_content">
    <div class="heading text_underline  ">
        all products
    </div>
    <div class="add_btn container mx-auto row py-3 ">
        <div class="col-6 mx-0">
            <a href="add-product.php" class="btn btn-dark text-capitalize">add new product
            </a>
        </div>
        <div class="col-6 mx-0 d-flex justify-content-end">
            <input id="search_input" type="text" class="form-control d-inline w-75" placeholder="search products">
            <button id="search_btn" class="btn btn-dark d-inline ml-3">search</button>
        </div>
    </div>

    <div class="content_wrapper mt-5 py-5">
        <table class="table table-striped table-hover text-capitalize">
            <thead class="thead-dark text-capitalize">
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>product name</th>
                    <th>category</th>
                    <th>sub-category</th>
                    <th>size</th>
                    <th>color</th>
                    <th>org price</th>
                    <th>dis price</th>
                    <th>discount</th>
                    <th>discription</th>
                    <th>stock</th>
                    <th style="min-width: 10vw;">status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody id="table_data">

            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {

            // SEARCH AND SHOW DATA IN TABLE 
            let search_input = $("#search_input");
            searchData("*");
            search_input.keyup(function() {
                searchData($(this).val().trim().toLowerCase())
            })

            $("#search_btn").on("click", function() {
                searchData($("#search_input").val().trim().toLowerCase());
            })

            function searchData(input) {
                if (input != " ") {
                    $.ajax({
                        url: "php_action_files/products.php",
                        type: 'POST',
                        data: {
                            input: input
                        },
                        success: function(result) {
                            console.log(result);
                            document.getElementById("table_data").innerHTML = result;
                            // $("#table_data").html(result);
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