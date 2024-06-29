<?php require 'header.php';
?>

<section id="add_product" class="main_content form_bg">
    <div class="heading text_underline">
        add new product
    </div>
    <div class="container position-relative text-capitalize">

        <form class="row m-3 p-3 g-3 add_product_form" id="add_product_form">
            <input type="hidden" name="insert" id="insert">
            <div class="col-12 my-3">
                <label for="name" class="form-label">product name</label>
                <input required type="text" class="form-control" name="name" id="name">
                <p id="err_name" style="color: red; font-size:.9rem; margin-top:.5rem;"></p>
            </div>

            <div class="col-12 my-3">
                <label for="discription" class="form-label">product discription</label>
                <textarea required class="form-control" rows="2" name="discription" id="discription"></textarea>
            </div>


            <div class="col-6 my-3">
                <label for="cate" class="form-label mr-3">select category</label>
                <select name="cate" id="cate" class="form-select px-3 py-1 text-capitalize">
                    <option value="" selected hidden>category</option>
                    <?php
                    $ob = new Database();
                    $ob->sql("SELECT cate_id,cate_name FROM category_tbl");
                    $select = $ob->getResult();
                    foreach ($select[0] as $key) {
                    ?>
                        <option value="<?php echo $key['cate_id']; ?>"><?php echo $key['cate_name']; ?></option>
                    <?php } ?>

                </select>
            </div>

            <div class="col-6 my-3">
                <label for="sub_cate" class="form-label mr-3">select sub category</label>
                <select required name="sub_cate" id="sub_cate" class="form-select px-3 py-1 text-capitalize">
                    <option value='' selected hidden>sub category</option>
                </select>
            </div>

            <div class="col-4 my-3">
                <label for="org_price" class="form-label">orignal price</label>
                <input required type="number" class="form-control" name="org_price" id="org_price">
            </div>
            <div class="col-4 my-3">
                <label for="dis_price" class="form-label">discounted price</label>
                <input required type="number" class="form-control" name="dis_price" id="dis_price">
            </div>
            <div class="col-4 my-3">
                <label for="discount" class="form-label">discount</label>
                <div class="input-group">
                    <input required type="number" class="form-control" name="discount" id="discount"><span class="input-group-text font_ss">%</span>
                </div>
            </div>

            <div class="col-6 my-3">
                <label for="color" class="form-label">product color</label>
                <input required type="text" class="form-control" name="color" id="color">
            </div>

            <div class="col-6 my-3">
                <label for="size" class="d-block">sizes</label>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" type="checkbox" name="size[]" id="s" value="1">
                    <label class="form-check-label" for="s">s</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" type="checkbox" name="size[]" id="m" value="2">
                    <label class="form-check-label" for="m">M</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" type="checkbox" name="size[]" id="l" value="3">
                    <label class="form-check-label" for="l">L</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" type="checkbox" name="size[]" id="xl" value="4">
                    <label class="form-check-label" for="xl">XL</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" type="checkbox" name="size[]" id="xxl" value="5">
                    <label class="form-check-label" for="xxl">XXL</label>
                </div>
                <div class="form-check form-check-inline mx-2">
                    <input class="form-check-input" type="checkbox" name="size[]" id="xxxl" value="6">
                    <label class="form-check-label" for="xxxl">XXXL</label>
                </div>
            </div>


            <div class="col-6 my-3">
                <label for="stock" class="form-label">stock</label>
                <input required type="number" class="form-control" name="stock" id="stock">
            </div>

            <div class="col-6 my-3">
                <label for="image" class="form-label">select product image</label>
                <input require accept="image/*" class="form-control file-btn p-0" type="file" name="image" id="image">
            </div>


            <div class="col-12 py-5">
                <button name="submit" id="submit" type="submit" class="btn btn-dark px-5 text-capitalize">add
                    product</button>
            </div>
        </form>

        <div class="alert alert-success align-items-center w-50 data_info_alert" role="alert">
            <i class="fa-solid fa-circle-check mr-4"></i>
            <div>
                product added successfully
            </div>
        </div>

        <div class="alert alert-danger align-items-center w-50 data_info_alert" role="alert">
            <i class="fa-solid fa-circle-xmark mr-4"></i>
            <div>
                somthing went wrong . product not added !!
            </div>
        </div>

    </div>
</section>
<script>
    $(document).ready(function() {
        // CONTROL CHARECTER LENGTH 
        $("#name").on("input",function(){
            if($("#name").val().length > 35){
                $("#err_name").html("only 35 characters are allowed..") 
            }
            else{
                $("#err_name").html("") 
            }
        })


        // SUB CATEGORY DIPENDENT SELECT BOX 
        $("#cate").on("change", function() {
            let id = $("#cate").val()
            $.ajax({
                url: "php_action_files/dipendent-sub-cate.php",
                type: "POST",
                data: {
                    type: "sub_cate",
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    document.getElementById("sub_cate").innerHTML = data;
                }
            })
        })

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
            if (result == 0) {
                showDataAlertBox(alertBox, "not updated!!")
                hideDataAlertBox(alertBox, 4000)
            }
            showDataAlertBox(alertBox, result)
            hideDataAlertBox(alertBox, 4000)
        }

        function showDataAlertBox(elem, err = "") {
            if (err != "") {
                elem.addClass("active");
                elem.html(err);
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
</header>
<?php
require 'footer.php';
?>
</body>

</html>