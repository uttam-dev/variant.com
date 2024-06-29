    <?php
    error_reporting(0);
    ?>


    <div class="nav-container">
        <div class="full_black_layer" data-dropdownContainer="menu" data-dropdownTarget="menu"> </div>
        <div class="full_black_layer" data-dropdownContainer="search_bar" data-dropdownTarget="search_bar"> </div>
        <ul>
            <li id="brand_logo" title="Variant">
                <a href="index.php">
                    <img src="assets\img\web_img\variant_logo.png" alt="">
                </a>
            </li>
            <li class="search_bar" title="search">
                <a href="#" data-dropdownTarget="search_bar">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                        <path opacity="1" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                    </svg>
                </a>

                <div class="search_input_wrapper" data-dropdownContainer="search_bar">
                    <div class="input-group px-5">
                        <?php
                        $search_value = "";
                        if (isset($_GET['search'])) {
                            $search_value = urldecode($_GET['search']);
                        } ?>
                        <input type="text" id="nav_search_input" value="<?php echo $search_value; ?>" class="form-control" placeholder="Search Products">
                        <span class="input-group-text font_ss" id="search_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                <path opacity="1" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </span>
                    </div>
                    <ul id="search_result" class="px-5 mt-4">
                    </ul>
                </div>
            </li>

            <li class="profile" title="profile">
                <a href="#" data-dropdownTarget="profile">
                    <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path opacity="1" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                        </svg></i>
                </a>

                <div class="dropdown" data-dropdownContainer="profile">
                    <?php if (isset($_SESSION['LOGIN'])) { ?>
                        <ul>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="orders.php">Order</a></li>
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" data-dropdownTarget="profile">Logout</a></li>
                        </ul>
                    <?php } else { ?>
                        <ul>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
                        </ul>
                    <?php } ?>
                </div>

            </li>


            <?php 
            $wishlistArr = array();
            if (isset($_SESSION['LOGIN'])) {
                $ob = new Database();
                $ob->select("wishlist_tbl", "*", null, "user_id=" . $_SESSION['LOGIN']['user_id']);
                $result = $ob->getResult();
                if(!empty($result)){
                    $wishlistArr = explode(",", trim($result[0]['pro_id'],","));
                }
                $wishlistArr = array_unique($wishlistArr);
                $wishlistArr = array_filter($wishlistArr,function($value){
                    return !empty($value);
                });
            } ?>
            <li class="nav-wishlist" title="wishlist">
                <a href="wishlist.php">
                    <i id="wishlist-count" <?php echo "data-iteam=".count($wishlistArr); ?>> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path opacity="1" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                        </svg></i>
                </a>
            </li>
            <li class="cart" title="cart">
                <a href="cart.php">
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $cartCount = count($_SESSION['cart']);
                    } else {
                        $cartCount = 0;
                    }
                    ?>
                    <i id="cart_count" <?php echo "data-iteam=$cartCount"; ?>> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path opacity="1" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                        </svg></i>
                </a>
            </li>

            <li class="menu" title="menu">
                <a href="#" data-dropdownTarget="menu">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                        <path opacity="1" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                    </svg>
                </a>

                <div class="menu_list" data-dropdownContainer="menu">
                    <ul>
                        <?php
                        $ob = new Database();
                        $ob->sql("SELECT cate_id , cate_name FROM category_tbl WHERE `status` = 1");
                        $res = $ob->getResult();
                        $res = $res[0];

                        foreach ($res as $cate) {
                            0
                        ?>
                            <li class="menu_list_iteam">
                                <div class="iteam" data-iteamTarget="<?php echo $cate['cate_id'] ?>">
                                    <a href="#"><?php echo $cate['cate_name'] ?></a>
                                    <i class="fa-solid fa-angle-down" data-dropdownContainer="<?php  echo $cate['cate_id'] ?>"></i>
                                </div>
                                <ul class="subcatagory" data-dropdownContainer="<?php echo $cate['cate_id'] ?>">
                                    <?php
                                    $ob->sql("SELECT * FROM sub_category_tbl WHERE `status` = 1 && cate_id = " . $cate['cate_id']);
                                    $sub = $ob->getResult();
                                    $sub = $sub[0];
                                    foreach ($sub as $val) {
                                        echo "<li><a href=products.php?sub_cate_id={$val['sub_cate_id']}>{$val['sub_cate_name']}</a></li>";
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
        </ul>
    </div>




    <!-- Logout Confirmation Modal -->

    <div class="modal fade mt-5 text-capitalize" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-lg">
                    <h3 class="modal-title font_rob font-weight-bolder mx-auto">do you really want to logout ? </h3>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <img src="assets/img/web_img/logout-vector.png" alt="" style="width:50%; ">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark rounded-sm mr-3 px-4" data-bs-dismiss="modal">Cansel</button>
                    <a type="button" class="btn btn-outline-dark rounded-sm px-4" href="php_files/logout.php?ref=login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>