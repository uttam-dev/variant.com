
    <?php require "header.php"; ?>

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
            <img src="admin_assets\img\web_img\forgot-vector.png" alt="">
        </div>
        <div class="login_form text-capitalize">
            <div class="container">
                <div class="heading">
                    Admin forgot password
                </div>
                <hr>
                <form id="forgot_form">

                    <div class="col">
                        <input class="input_box" placeholder="* user" id="username" name="username">
                        <p class="err" id="err_user"></p>
                    </div>

                    <div class="col">
                        <input type="password" class="input_box" placeholder="* new password" id="pass" name="pass">
                        <p class="err" id="err_pass"></p>
                    </div>

                    <div class="col">
                        <input type="password" class="input_box" placeholder="* confirm password" id="cpass" name="cpass">
                        <p class="err" id="err_cpass"></p>
                    </div>

                    <div class="col omy-2 ml-2">
                        <a href="index.php" class="cta-link text-info">back to login page..</a>
                    </div>

                    <div class="btn-wrepper">
                        <input type="submit" class="btn btn-dark input_box m-auto" value="Change Password">
                    </div>


                </form>
            </div>
        </div>
    </div>
  
    <div class="alert alert-success align-items-center w-50 data_info_alert data_info_alert-succsess " role="alert">
        <i class="fa-solid fa-circle-check mr-4"></i>
        <div>
            password change successfully
        </div>
    </div>
   
    <div class="alert alert-danger align-items-center w-50 data_info_alert data_info_alert-danger" role="alert">
        <i class="fa-solid fa-circle-xmark mr-4"></i>
        <div>
            password change successfully
        </div>
    </div>

    <script>
        
  // *******************************************************************************************************************
  // FORGOT PASSWORD FORM ****************
  // *******************************************************************************************************************

  $("#forgot_form").on("submit", function (event) {
    event.preventDefault();

    if ($("#username").val() == "") {
      $("#email").focus();
      $("#err_user").html("please enter username");
      return;
    } else {
      $("#err_username").html("");
    }

    if ($("#pass").val() == "") {
      $("#pass").focus();
      $("#err_pass").html("please enter your password");
      return;
    } else {
      $("#err_pass").html("");
    }

    if ($("#cpass").val() == "") {
      $("#cpass").focus();
      $("#err_cpass").html("please enter your confirm password");
      return;
    } else {
      $("#err_cpass").html("");
    }

    if ($("#pass").val() != $("#cpass").val()) {
      $("#cpass").focus();
      $("#err_cpass").html("password not match");
      return;
    } else {
      $("#err_cpass").html("");
    }

    let formData = new FormData(this);
    $.ajax({
      url: "php_action_files/forgot.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (result) {
        $("#op").html(result);

        if (result == "email_err") {
          $("#email").focus();
          $("#err_user").html("username does not match");
        } else if (result == "pass_err") {
          $(".data_info_alert-danger").html("password not changed.");
          $(".data_info_alert-danger").addClass("active");
          setTimeout(() => {
            $("data_info_alert.data_info_alert-danger").removeClass("active");
          }, 5000);
        } else if (result == "success") {
          $(".data_info_alert.data_info_alert-succsess").addClass("active");
          setTimeout(() => {
            window.location.href = "dashboard.php";
          }, 1000);
        } else if (result == "password alredy exist") {
          $("#err_cpass").html("password alredy exist");
        }
      },
    });
  });
    </script>
</body>

</html>