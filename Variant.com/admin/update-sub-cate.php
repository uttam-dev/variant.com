<?php require 'header.php';


if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}


if (isset($_GET['sub_cate_id']) && $_GET['sub_cate_id'] != "") {
    $sub_cate_id = $_GET['sub_cate_id'];
} else {
    header("location:sub-category.php");
}

$db = new Database();
$db->sql("SELECT * FROM sub_category_tbl WHERE sub_cate_id=" . $sub_cate_id);
$res = $db->getResult();
$res = $res[0][0];
?>

<section id="update-sub-cate" class="main_content form_bg">
    <div class="heading text_underline  ">
        update sub categories
    </div>
    <form class="add_cate container row mx-auto my-5 text-capitalize" id="add_cate" name="add_cate">
        <input type="hidden" name="update" id="update">
        <div class="col-12 my-3">
            <label for="sub_cate_id" class="form-label">sub-category id</label>
            <input readonly type="number" class="form-control" name="sub_cate_id" id="sub_cate_id" value=<?php echo $res['sub_cate_id']; ?>>
        </div>

        <div class="col-12 my-3">
            <label for="cate_id" class="form-label"> category name</label>
            <select class="form-control" name="cate_id" id="cate_id">
                <?php
                $ob2 = new Database();
                $ob2->sql("SELECT cate_id,cate_name FROM category_tbl");
                $select = $ob2->getResult();

                foreach ($select[0] as $key) { ?>
                    <option value=<?php echo "'{$key['cate_id']}'"; if( $res['cate_id']==$key['cate_id']) echo"selected";?>>
                        <?php echo $key['cate_name']; ?>
                    </option>
                <?php }  ?>
            </select>
        </div>

        <div class="col-12 my-3">
            <label for="sub_cate_name" class="form-label">sub-category name</label>
            <input required type="text" class="form-control" name="sub_cate_name" id="sub_cate_name" value="<?php echo $res['sub_cate_name']; ?>">
        </div>

        <div class="col-3 my-5">
            <button type="submit" id="#add_product_form" class="btn btn-dark text-capitalize">update sub-category</button>
        </div>

        <div class="alert alert-success align-items-center w-50 data_info_alert" role="alert">
            <i class="fa-solid fa-circle-check mr-4"></i>
            <div>
                category updated successfully
            </div>
        </div>

        <div class="alert alert-danger align-items-center w-50 data_info_alert" role="alert">
            <i class="fa-solid fa-circle-xmark mr-4"></i>
            <div id="error_text">
                somthing went wrong . category not added !!
            </div>
        </div>

    </form>

    <div id="err"></div>
    <script>
        $(document).ready(function () {

            $("#add_cate").on("submit", function (event) {
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
                        dataAlertBox(result);

                        if (result == 1) {
                            document.getElementById("add_product_form").reset();
                        }
                    },
                })
            })

              // DATA ALERT BOX
        function dataAlertBox(result) {

            if (result == "succsess") {
                let alertBox = $(".data_info_alert.alert-success")
                showDataAlertBox(alertBox)
                setTimeout(function(){
                    window.location.href='./sub-category.php';
                },1000)
                return;
            }

            if (result == 1) {
                let alertBox = $(".data_info_alert.alert-success")
                showDataAlertBox(alertBox)
                hideDataAlertBox(alertBox, 3000)
            }
            else {
                let alertBox = $(".data_info_alert.alert-danger")
                showDataAlertBox(alertBox, result)
                hideDataAlertBox(alertBox, 4000)
            }

            function showDataAlertBox(elem, err = "") {
                if (err != "") {
                    elem.addClass("active");
                    $(".data_info_alert.alert-danger > #error_text").html(err);
                }
                else
                    elem.addClass("active");
            }

            function hideDataAlertBox(elem, time) {
                setTimeout(() => {
                    elem.removeClass("active")
                }, time)
            }
        }
        });

    </script>
</section>
</header>
<?php
require 'footer.php';
?>
</body>

</html>