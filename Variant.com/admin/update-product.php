<?php require 'header.php';


if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}


if (isset($_GET['pro_id']) && $_GET['pro_id'] != "") {
    $pro_id = $_GET['pro_id'];
} else {
    header("location:products.php");
}

$db = new Database();
$db->sql("SELECT * FROM products_tbl WHERE pro_id=" . $pro_id);
$res = $db->getResult();
$res = $res[0][0];

?>

<section id="update_product" class="main_content form_bg">
    <div class="heading text_underline">
        update product
    </div>
    <div class="container position-relative font_rob text-capitalize">

        <form class="row m-3 p-3 g-3 add_product_form" id="add_product_form">
            <input type="hidden" name="update" id="update">

            <div class="col-12 my-3">
                <label for="pro_id" class="form-label">product id</label>
                <input required readonly type="text" class="form-control" name="pro_id" id="pro_id" value="<?php echo $res["pro_id"]; ?>">
            </div>

            <div class="col-12 my-3">
                <label for="name" class="form-label">product name</label>
                <input required type="text" class="form-control" name="name" id="name" value="<?php echo $res['name']; ?>">
                <p id="err_name" style="color: red; font-size:.9rem; margin-top:.5rem;"></p>
            </div>

            <div class="col-12 my-3">
                <label for="discription" class="form-label">product discription</label>
                <textarea required class="form-control" rows="2" name="discription" id="discription"><?php echo $res['discription']; ?></textarea>
            </div>

            <div class="col-6 my-3">
                <label for="cate" class="form-label mr-5">select category</label>
                <select name="cate" id="cate" class="form-select px-3 py-1 text-capitalize">
                    <?php
                    $ob = new Database();
                    $ob->sql("SELECT cate_id,cate_name FROM category_tbl");
                    $select = $ob->getResult();
                    foreach ($select[0] as $key) {
                    ?>
                        <option value=<?php echo "'{$key['cate_id']}'";
                                        if ($res['cate_id'] == $key['cate_id'])
                                            echo "selected"; ?>>
                            <?php echo $key['cate_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-6 my-3">
                <label for="sub_cate" class="form-label mr-5">select sub category</label>
                <select required name="sub_cate" id="sub_cate" class="form-select px-3 py-1 text-capitalize">

                </select>
            </div>

            <div class="col-4 my-3">
                <label for="org_price" class="form-label">orignal price</label>
                <input required type="number" class="form-control" name="org_price" id="org_price" value="<?php echo $res['org_price']; ?>">
            </div>
            <div class="col-4 my-3">
                <label for="dis_price" class="form-label">discounted price</label>
                <input required type="number" class="form-control" name="dis_price" id="dis_price" value="<?php echo $res['dis_price']; ?>">
            </div>
            <div class="col-4 my-3">
                <label for="discount" class="form-label">discount</label>
                <div class="input-group">
                    <input required type="number" class="form-control" name="discount" id="discount" value="<?php echo $res['discount']; ?>"><span class="input-group-text font_ss">%</span>
                </div>
            </div>


            <div class="col-6 my-3">
                <label for="color" class="form-label">product color</label>
                <input required type="text" class="form-control" name="color" id="color" value="<?php echo $res['color']; ?>">
            </div>

            <div class="col-6 my-3">
                <label for="size" class="d-block">sizes</label>
                <?php
                $sizes = explode(",", $res['size']);
                $checked1 = $checked2 = $checked3 = $checked4 = $checked5 = $checked6 = "";
                foreach ($sizes as $size) {
                    if ($size == 1)
                        $checked1 = "checked";
                    if ($size == 2)
                        $checked2 = "checked";
                    if ($size == 3)
                        $checked3 = "checked";
                    if ($size == 4)
                        $checked4 = "checked";
                    if ($size == 5)
                        $checked5 = "checked";
                    if ($size == 6)
                        $checked6 = "checked";
                }
                ?>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" <?php echo $checked1; ?> type="checkbox" name="size[]" id="s" value="1">
                    <label class="form-check-label" for="s">s</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" <?php echo $checked2; ?> type="checkbox" name="size[]" id="m" value="2">
                    <label class="form-check-label" for="m">M</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" <?php echo $checked3 ?> type="checkbox" name="size[]" id="l" value="3">
                    <label class="form-check-label" for="l">L</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" <?php echo $checked4; ?> type="checkbox" name="size[]" id="xl" value="4">
                    <label class="form-check-label" for="xl">XL</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" <?php echo $checked5; ?> type="checkbox" name="size[]" id="xxl" value="5">
                    <label class="form-check-label" for="xxl">XXL</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" <?php echo $checked6; ?> type="checkbox" name="size[]" id="xxxl" value="6">
                    <label class="form-check-label" for="xxxl">XXXL</label>
                </div>
            </div>


            <div class="col-6 my-3">
                <label for="stock" class="form-label">stock</label>
                <input required type="number" class="form-control" name="stock" id="stock" value="<?php echo $res['stock']; ?>">
            </div>

            <div class="col-6 my-3">
                <label for="image" class="form-label">select product image</label>
                <input require accept="image/*" class="form-control file-btn p-0" type="file" name="image" id="image">
            </div>


            <div class="col-12 py-5">
                <button name="update" id="update" type="submit" class="btn btn-dark px-5 text-capitalize">update
                    product</button>
            </div>
        </form>

        <div class="alert alert-success align-items-center w-50 data_info_alert" role="alert">
            <i class="fa-solid fa-circle-check mr-4"></i>
            <div>
                product updated successfully
            </div>
        </div>

        <div class="alert alert-danger align-items-center w-50 data_info_alert" role="alert">
            <i class="fa-solid fa-circle-xmark mr-4"></i>
            <div id="error_text">
                somthing went wrong . product not added !!
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
           
            // CONTROL CHARECTER LENGTH 
            $("#name").on("input", function() {
                if ($("#name").val().length > 30) {
                    console.log($("#name").val().length);
                    $("#err_name").html("only 30 characters are allowed..")
                } else {
                    $("#err_name").html("")
                }
            })

            
            // SUB CATEGORY DIPENDENT SELECT BOX 
            let cate = document.getElementById("cate");

            loadSubCate(cate.value);

            cate.addEventListener("change", function() {
                let id = cate.value;
                loadSubCate(id);
            })

            function loadSubCate(id) {
                let subId = "<?php echo $res['sub_cate_id']; ?>";
                $.ajax({
                    url: "php_action_files/dipendent-sub-cate.php",
                    type: "POST",
                    data: {
                        subId: subId,
                        id: id
                    },
                    success: function(data) {
                        document.getElementById("sub_cate").innerHTML = data;
                    }
                })
            }


            // AUTO FILL UP PRICE AND DISCOUNT RATES
            let op = document.getElementById("org_price")
            let dp = document.getElementById("dis_price")
            let dis = document.getElementById("discount")

            function getDisPrice(org_price, discount) {
                dp.value = Math.round(org_price - (org_price * (discount / 100)));
            }

            function getDiscount(org_price, dis_price) {
                dis.value = Math.round((org_price - dis_price) / org_price * 100);
            }

            dis.addEventListener("input", function() {
                if (op.value != "") {
                    getDisPrice(op.value, dis.value)
                }
            })
            dp.addEventListener("input", function() {
                if (op.value != "") {
                    getDiscount(op.value, dp.value)
                }
            })


            $("#add_product_form").on("submit", function(event) {
                event.preventDefault();

                //  SELECT OPTION VALIDATION
                let cate = $("#cate");
                let sub_cate = $("#sub-cate");
                if (cate.val() == "") {
                    dataAlertBox("please select category !!")
                    cate.focus();
                    return;
                }
                if (sub_cate.val() == "") {
                    dataAlertBox("please select sub category !!")
                    sub_cate.focus();
                    return;
                }

                // AJEX :::
                let formData = new FormData(this)
                $.ajax({
                    url: "php_action_files/products.php",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        dataAlertBox(result);

                        if (result == 1) {
                            document.getElementById("add_product_form").reset();
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
            } else {
                let alertBox = $(".data_info_alert.alert-danger")
                showDataAlertBox(alertBox, result)
                hideDataAlertBox(alertBox, 4000)
            }

            function showDataAlertBox(elem, err = "") {
                if (err != "") {
                    elem.addClass("active");
                    $(".data_info_alert.alert-danger > #error_text").html(err);
                } else
                    elem.addClass("active");
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