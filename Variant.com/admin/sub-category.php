<?php require 'header.php';


if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}


if (
    isset($_GET['type']) && $_GET['type'] != ""
    && isset($_GET['sub_cate_id']) && $_GET['sub_cate_id'] != ""
) {

    $type = mysqli_escape_string($conn, $_GET['type']);
    $sub_cate_id = mysqli_escape_string($conn, $_GET['sub_cate_id']);

    $ob = new Database();

    if ($type == "status") {
        if (isset($_GET['operation']) && $_GET['operation'] != "") {
     
            if ($_GET['operation'] == "active") {
                $ob->sql("UPDATE sub_category_tbl SET `status` = 1 WHERE sub_cate_id= " . $sub_cate_id);
       
            } else if ($_GET['operation'] == "deactive") {
                $ob->sql("UPDATE sub_category_tbl SET `status` = 0 WHERE sub_cate_id= " . $sub_cate_id);
       
            }
        }
    }

    if ($type == "delete") {
        $ob->delete("sub_category_tbl", "sub_cate_id=" . $sub_cate_id);
    }

}
?>

<section id="sub-cate" class="main_content">
    <div class="heading text_underline  ">
        all sub-categories
    </div>
    <div class="py-3 container">
        <div class="d-flex justify-content-end">
            <input id="search_input" type="text" class="form-control d-inline w-25 mr-3 text-capitalize"
                placeholder="search sub-category">
            <button id="search_btn" class="btn btn-dark d-inline ml-2 text-capitalize">search</button>
        </div>
    </div>
    <form id="sub_cate_form" class="container row mx-auto text-capitalize">
        <input type="hidden" name="insert" id="insert">
        <div class="col my-3">
            <label for="cate_id" class="form-label">product category</label>
            <select class="form-control" name="cate_id" id="cate_id">
                <?php
                $ob = new Database();
                $ob->sql("SELECT cate_id,cate_name FROM category_tbl");
                $select = $ob->getResult();

                foreach ($select[0] as $key) { ?>
                    <option value=<?php echo "'{$key['cate_id']}'"; ?>>
                        <?php echo $key['cate_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col my-3">
            <label for="sub_cate_name" class="form-label">product sub category</label>
            <input required type="text" class="form-control" name="sub_cate_name" id="sub_cate_name">
        </div>
        <div class="col-3 my-5 px-0 d-flex justify-content-end">
            <button type="submit" class="btn btn-dark ml-5 text-capitalize">add sub-category</a>
        </div>
    </form>
    <div class="content_wrapper mt-5">
        <table class="table table-striped table-hover text-capitalize">
            <thead class="thead-dark text-capitalize">
                <tr>
                    <th>sub-category id</th>
                    <th>category name</th>
                    <th>sub-category name</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody id="table_data">

            </tbody>
        </table>
    </div>

    <div class="alert alert-success align-items-center w-50 data_info_alert text-capitalize" role="alert">
            <i class="fa-solid fa-circle-check mr-4"></i>
            <div>
                sub-category added successfully
            </div>
        </div>

        <div class="alert alert-danger align-items-center w-50 data_info_alert text-capitalize" role="alert">
            <i class="fa-solid fa-circle-xmark mr-4"></i>
            <div id="error_text">
                somthing went wrong . category not added !!
            </div>
        </div>

    <div id="err"> </div>
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
                        url: "php_action_files/sub-cate.php",
                        type: 'POST',
                        data: { input: input },
                        success: function (result) {
                            $("#table_data").html(result);
                        },
                    })
                }
            }


            $("#sub_cate_form").on("submit", function (event) {
                event.preventDefault();

                // AJEX :::
                let formData = new FormData(this)
                $.ajax({
                    url: "php_action_files/sub-cate.php",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        document.getElementById("err").innerHTML=result
                        dataAlertBox(result);

                        if (result == 1) {
                            document.getElementById("sub_cate_form").reset();
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
                    document.querySelector(".data_info_alert.alert-danger  #error_text").innerHTML = err;
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