<?php

error_reporting(0);

require 'header.php';
?>

<style>
    .main-wrapper {
        height: 100vh;
        background-color: #f3f3f3;
        background: url('admin_assets/img/web_img/form-background.png');
        background-position: center;
        object-fit: cover;
        background-attachment: fixed;
    }
</style>

<div class="main-wrapper login">
    <div class="vecotor_img">
        <img src="admin_assets\img\web_img\login-vector.png" alt="">
    </div>
    <div class="login_form text-capitalize">
        <div class="container">
            <div class="heading">
                admin login
            </div>
            <hr>
            <form id="login_form">

                <div class="col">
                    <input type="text" class="input_box text-lowercase" placeholder="* username" id="email" name="email">
                    <p class="err" id="err_email"></p>
                </div>

                <div class="col">
                    <input type="password" class="input_box" placeholder="* password" id="pass" name="pass">
                    <p class="err" id="err_pass"></p>
                </div>
                <div class="col omy-2 ml-2">
                    <a href="forgot-password.php" class="cta-link text-info">forgot password</a>
                </div>

                <div class="btn-wrepper">
                    <input type="submit" class="btn btn-dark input_box m-auto" value="Submit">
                </div>

            </form>
        </div>
    </div>
</div>
<div id="op"></div>
<div class="alert alert-success align-items-center w-50 data_info_alert" role="alert">
    <i class="fa-solid fa-circle-check mr-4"></i>
    <div>
        you are login successfully
    </div>
</div>

<script>
    $(document).ready(function() {
        // LOGIN FORM ****************
        $("#login_form").on("submit", function(event) {
            event.preventDefault();

            if ($("#email").val() == "") {
                $("#email").focus();
                $("#err_email").html("please enter your email");
                return
            } else {
                $("#err_email").html("");
            }

            if ($("#pass").val() == "") {
                $("#pass").focus();
                $("#err_pass").html("please enter your password");
                return
            } else {
                $("#err_pass").html("");
            }


            let formData = new FormData(this);
            $.ajax({
                url: "php_action_files/login.php",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {

                    // console.log(result);
                    // $("#op").html(result);
                    if (result == "email_err") {
                        $("#email").focus();
                        $("#err_email").html("email does not match");
                    } else if (result == "pass_err") {
                        $("#pass").focus();
                        $("#err_pass").html("password does not match");

                    } else if (result == "success") {
                        $(".data_info_alert").addClass("active");
                        setTimeout(() => {

                            window.location.href = "dashboard.php";

                        }, 1000);
                    }
                },
            })
        })
    })
</script>

</body>

</html>