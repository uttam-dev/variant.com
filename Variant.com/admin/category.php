<?php require 'header.php';

if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}

if (
    isset($_GET['type']) && $_GET['type'] != ""
    && isset($_GET['cate_id']) && $_GET['cate_id'] != ""
) {

    $type = mysqli_escape_string($conn, $_GET['type']);
    $cate_id = mysqli_escape_string($conn, $_GET['cate_id']);

    $ob = new Database();

    if ($type == "status") {
        if (isset($_GET['operation']) && $_GET['operation'] != "") {
            if ($_GET['operation'] == "active") {
                $ob->sql("UPDATE category_tbl SET status = 1 WHERE cate_id = " . $cate_id);
            } else if ($_GET['operation'] == "deactive") {
                $ob->sql("UPDATE category_tbl SET status = 0 WHERE cate_id = " . $cate_id);
            }
        }
    }

    if ($type == "delete") {

        $ob->sql("SELECT `image` FROM `category_tbl` WHERE `cate_id`=".$cate_id);
        $old_img = $ob->getResult();

        $ob->delete("category_tbl", "cate_id = " . $cate_id);
        $result = $ob->getResult();
        // $ob->sql("DELETE category WHERE cate_id = " . $cate_id);
        // $result = $ob->getResult();
        
        // print_r($result);
        // die();
        if($result[0]==1){
            unlink(CATEGORY_IMG_SERVER_PATH.$old_img[0][0]['image']);
            echo "<script> dataAlertBox(1); </script>";
        }
    }

}
?>

<section id="cate" class="main_content">
    <div class="heading text_underline  ">
        all categories
    </div>
    <div class="py-3 container">
        <div class="d-flex justify-content-end ">
            <input id="search_input" type="text" class="form-control d-inline w-25 mr-3 text-capitalize"
                placeholder="search category">
            <button id="search_btn" class="btn btn-dark d-inline ml-2 text-capitalize">search</button>
        </div>
    </div>

    <form id="add_cate_form" class="container row mx-auto text-capitalize">
        <input type="hidden" name="insert" id="insert">
        <div class="col my-3">
            <label for="name" class="form-label">product category</label>
            <input required type="text" class="form-control" name="cate_name" id="cate_name">
        </div>
        <div class="col my-3">
            <label for="image" class="form-label">select product image</label>
            <input require accept="image/*" class="form-control file-btn p-0" type="file" name="image" id="image">
        </div>
        <div class="col-3 my-5 px-0 d-flex justify-content-end">
            <button type="submit" class=" btn btn-dark text-capitalize" name="add_cate" id="add_cate">add new
                category</button>
        </div>
    </form>

    <div class="content_wrapper mt-5">
        <table class="table table-striped table-hover text-capitalize">
            <thead class="thead-dark text-capitalize">
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>category name</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody id="table_data">

            </tbody>
        </table>
        <div class="alert alert-success align-items-center w-50 data_info_alert text-capitalize" role="alert">
            <i class="fa-solid fa-circle-check mr-4"></i>
            <div>
                product added successfully
            </div>
        </div>

        <div class="alert alert-danger align-items-center w-50 data_info_alert text-capitalize" role="alert">
            <i class="fa-solid fa-circle-xmark mr-4"></i>
            <div id="error_text ">
                somthing went wrong . product not added !!
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {

            let search_input = $("#search_input");

            searchData("*")

            search_input.keyup(function () {
                searchData($(this).val().trim().toLowerCase())
            })

            $("#search_btn").on("click", function () {
                searchData($("#search_input").val().trim().toLowerCase());
            })

            function searchData(input) {
                if (input != " ") {
                    $.ajax({
                        url: "php_action_files/cate.php",
                        type: 'POST',
                        data: { input: input },
                        success: function (result) {
                            $("#table_data").html(result);
                        },
                    })
                }
            }


            $("#add_cate_form").on("submit", function (event) {
                event.preventDefault();

                // AJEX :::
                let formData = new FormData(this)
                $.ajax({
                    url: "php_action_files/cate.php",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (result) {

                        dataAlertBox(result);

                        if (result == 1) {
                            document.getElementById("add_cate_form").reset();
                            searchData("*");
                        }
                    },
                })
            })
        });

        // DATA ALERT BOX
        function dataAlertBox(result) {
            if (result == 1) {
                let alertBox = $(".data_info_alert.alert-success")
                showDataAlertBox(alertBox)
                hideDataAlertBox(alertBox, 3000)
            }
            else {
                let alertBox = $(".data_info_alert.alert-danger")
                if (result == 0) {
                    showDataAlertBox(alertBox, "not updated!!")
                    hideDataAlertBox(alertBox, 4000)
                }
                else {
                    // console.log(result);
                    showDataAlertBox(alertBox, result)
                    hideDataAlertBox(alertBox, 3000)
            }
            }

            function showDataAlertBox(elem, err = "") {
                if (err != "") {
                    console.log(err);
                    elem.addClass("active");
                    document.querySelector(".data_info_alert.alert-danger  #error_text").innerHTML=err;
                }
                else { 
                    elem.addClass("active"); 
                }
            }

            function hideDataAlertBox(elem, time) {
                setTimeout(() => {
                    elem.removeClass("active")
                }, time)
            }
        }

    </script>

</section>
</header>
<?php
require 'footer.php';
?>
</body>

</html>