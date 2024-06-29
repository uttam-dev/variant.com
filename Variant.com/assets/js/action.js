// @2024 UTTAM PRAJAPATI

$(document).ready(function () {


  // *******************************************************************************************************************
  // WISHLIST FUNCTIONALITY ADD OR REMOVE
  // *******************************************************************************************************************

  $("[wishlist_icon]").on("click", function (icon) {
    let pro_id = $(this).parent().siblings().attr("href").split("=")[1];
    let elem = $(this);

    if ($(this).hasClass("active")) {
      $.ajax({
        url: "php_files/wishlist-manage.php",
        type: "POST",
        data: { remove: "", pro_id: pro_id },
        success: function (result) {
          console.log("remove");
          if (result == 1) {
            let wishlist_count = $("#wishlist-count").attr("data-iteam");
            $("#wishlist-count").attr("data-iteam", --wishlist_count);
            elem.removeClass("active");
          }
        },
      });
    } else {
      $.ajax({
        url: "php_files/wishlist-manage.php",
        type: "POST",
        data: { add: "", pro_id: pro_id },
        success: function (result) {
        console.log(result);
        $("#op").html(result);
        // return;
        if (result == "not login") {
            $("#notLogInModal").modal("show");
          } else if (result == 1) {
            let wishlist_count = $("#wishlist-count").attr("data-iteam");
            $("#wishlist-count").attr("data-iteam", ++wishlist_count);

            $(".nav-wishlist").animate({ scale: 1.3 });
            $(".nav-wishlist").animate({ scale: 1 });
            elem.addClass("active");
          }
        },
      });
    }
  });

  // *******************************************************************************************************************
  // SEARCH AND SHOW DATA ********************************
  // *******************************************************************************************************************
  let search_input = $("#nav_search_input");
  search_input.keyup(function (event) {
    if (search_input.val().trim() != "") {
      if (event.which === 13) {
        redirectForSearch();
        return;
      }
    }
    searchData(search_input.val().trim().toLowerCase());
  });

  $("#search_btn").click(function () {
    if (search_input.val().trim() != "") {
      redirectForSearch();
    }
  });

  function redirectForSearch() {
    window.location.href =
      "products.php?search=" +
      encodeURIComponent(search_input.val().trim().toLowerCase());
    }
    
    searchData(search_input.val());
    
    function searchData(input) {
      $.ajax({
        url: "php_files/search_products.php",
        type: "POST",
        data: { input: input },
        success: function (result) {
          $("#search_result").html(result);
        },
      });
  }

  // *******************************************************************************************************************
  // REGISTER *****************************
  // *******************************************************************************************************************
  
  $("#register_form").on("submit", function (event) {
    event.preventDefault();

    if ($("#mobile").val().length != 10) {
      $("#mobile").focus();
      $("#err_mobile").html("mobile number must be 10 digits ");
      return;
    } else {
      $("#err_mobile").html("");
    }
    
    if ($("#password").val() != $("#cpassword").val()) {
      $("#cpassword").focus();
      $("#err_cpass").html("password not match");
      return;
    } else {
      $("#err_cpass").html("");
    }

    let formData = new FormData(this);
    $.ajax({
      url: "php_files/reg.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (result) {
        if (result == "exist") {
          $("#email").focus();
          $("#err_email").html("email already exist");
        } else {
          $(".data_info_alert").addClass("active");
          setTimeout(() => {
            window.location.href = "login.php";
          }, 1500);
        }
      },
    });
  });

  // *******************************************************************************************************************
  // LOGIN FORM ****************
  // *******************************************************************************************************************
  $("#login_form").on("submit", function (event) {
    event.preventDefault();

    if ($("#email").val() == "") {
      $("#email").focus();
      $("#err_email").html("please enter your email");
      return;
    } else {
      $("#err_email").html("");
    }

    if ($("#pass").val() == "") {
      $("#pass").focus();
      $("#err_pass").html("please enter your password");
      return;
    } else {
      $("#err_pass").html("");
    }

    let formData = new FormData(this);
    $.ajax({
      url: "php_files/login.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (result) {
        console.log(result);
        $("#op").html(result);
        if (result == "email_err") {
          $("#email").focus();
          $("#err_email").html("email or username does not match");
        } else if (result == "pass_err") {
          $("#pass").focus();
          $("#err_pass").html("password does not match");
        } else if (result == "success") {
          $(".data_info_alert").addClass("active");
          setTimeout(() => {
            let params = new URLSearchParams(window.location.search);
            let value = params.get("ref");
            if (value != null) {
              window.location.href = value;
            } else {
              window.location.href = "index.php";
            }
          }, 1000);
        } else if (result == "admin_succsess") {
          $(".data_info_alert").addClass("active");
          setTimeout(() => {
            window.location.href = "admin/dashboard.php";
          }, 1000);
        }
      },
    });
  });

  // *******************************************************************************************************************
  // FORGOT PASSWORD FORM ****************
  // *******************************************************************************************************************

  $("#forgot_form").on("submit", function (event) {
    event.preventDefault();

    if ($("#email").val() == "") {
      $("#email").focus();
      $("#err_email").html("please enter your email");
      return;
    } else {
      $("#err_email").html("");
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
      url: "php_files/forgot.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (result) {
        $("#op").html(result);

        if (result == "email_err") {
          $("#email").focus();
          $("#err_email").html("email does not match");
        } else if (result == "pass_err") {
          $(".data_info_alert-danger").html("password not changed.");
          $(".data_info_alert-danger").addClass("active");
          setTimeout(() => {
            $("data_info_alert.data_info_alert-danger").removeClass("active");
          }, 5000);
        } else if (result == "success") {
          $(".data_info_alert.data_info_alert-succsess").addClass("active");
          setTimeout(() => {
            window.location.href = "login.php";
          }, 1000);
        } else if (result == "password alredy exist") {
          $("#err_cpass").html("password alredy exist");
        }
      },
    });
  });


  // *******************************************************************************************************************
  // FEEDBACK FORM SUBMIT
  // *******************************************************************************************************************

  $("#feedback_form").on("submit", function (elem) {
    elem.preventDefault();

    let formData = new FormData(this);
    $.ajax({
      url: "php_files/feedback-add.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (result) {
        if (result) {
          $("#feedback_form")[0].reset();
          $("#feedbackThanks").modal("show");
          setTimeout(function () {
            $("#feedbackThanks").modal("hide");
          }, 3000);
        }
      },
    });
  });


  // *******************************************************************************************************************
  // SINGLE PRODUCT QUANTITY CHANGE
  // *******************************************************************************************************************

  $("#qty_increment").on("click", function (elem) {
    elem.preventDefault();
    let qty = document.getElementById("qty").value;
    document.getElementById("qty").value = qty == 10 ? 10 : ++qty;
  });

  $("#qty_decrement").on("click", function (elem) {
    elem.preventDefault();
    let qty = document.getElementById("qty").value;
    document.getElementById("qty").value = qty == 1 ? 1 : --qty;
  });


  // *******************************************************************************************************************
  //ADD TO CART FROM SINGLE PRODUCT PAGE
  // *******************************************************************************************************************

  $("#add_to_cart").on("click", function (elem) {
    elem.preventDefault();
    let sizeaBtn = document.querySelector('input[name="sizes"]:checked');
    if (sizeaBtn == null || sizeaBtn == "") {
      alert("Please Select Size");
    } else {
      let pro_id = $("#pro_id").val();
      let size = sizeaBtn.value;
      let qty = $("#qty").val();

      $.ajax({
        url: "php_files/cart_manage.php",
        type: "POST",
        data: { pro_id: pro_id, size: size, qty: qty },
        success: function (result) {
          if (result == "Product Is Already Exist In Cart") {
            alert(result);
          } else {
            if (typeof (result == "number")) {
              document
                .getElementById("cart_count")
                .setAttribute("data-iteam", result);
              $(".cart").animate({ scale: 1.3 });
              $(".cart").animate({ scale: 1 });
              $(".data_info_alert.data_info_alert-succsess").addClass("active");
              setTimeout(function () {
                $(".data_info_alert.data_info_alert-succsess").removeClass(
                  "active"
                );
              }, 3000);
            } else {
              console.log(result);
            }
          }
        },
      });
    }
  });

  // *******************************************************************************************************************
  // BUY IT NOW BTN
  // *******************************************************************************************************************
  $("#buy_it_now").on("click", function (elem) {
    elem.preventDefault();
    let sizeaBtn = document.querySelector('input[name="sizes"]:checked');
    if (sizeaBtn == null || sizeaBtn == "") {
      alert("Please Select Size");
    } else {
      let pro_id = $("#pro_id").val();
      let size = sizeaBtn.value;
      let qty = $("#qty").val();

      let login = null;

      $.ajax({
        url: "php_files/login.php",
        type: "POST",
        data: { check_login: " " },
        success: function (result) {
          if (result == 1) {
            cartManage();
          } else {
            loginThanBuy();
          }
        },
      });

      function cartManage() {
        $.ajax({
          url: "php_files/cart_manage.php",
          type: "POST",
          data: { buy_it_now: "", pro_id: pro_id, size: size, qty: qty },
          success: function (result) {
            if (result) {
              window.location.href = "process-order-single.php";
            }
          },
        });
      }
      function loginThanBuy() {
        window.location.href =
          "login.php?ref=single-product.php?pro_id=" + pro_id;
      }
    }
  });

  // *******************************************************************************************************************
  // PLACE ORDER FROM MY CART
  // *******************************************************************************************************************
  $("#cart-place-order-btn").on("click", function (elem) {
    elem.preventDefault();
    $.ajax({
      url: "php_files/login.php",
      type: "POST",
      data: { check_login: "" },
      success: function (result) {
        console.log(result);
        if (result == 1) {
          window.location.href = "process-order.php";
        } else if (result == 0) {
          if (confirm("Please LogIn For Place Your Order..")) {
            window.location.href = "login.php?ref=cart.php";
          }
        }
      },
    });
  });

  // *******************************************************************************************************************
  // CONFIRM ORDER FROM PROCESS ORDER
  // *******************************************************************************************************************
  $("#process-order-form").on("submit", function (elem) {
    elem.preventDefault();
    let formData = new FormData(this);

    $.ajax({
      url: "php_files/order-add.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (result) {
        if (result) {
          $("#orderSuccsessMassage").modal("show");
          setTimeout(function () {
            window.location.href = "orders.php";
          }, 3000);
        }
      },
    });
  });

  // *******************************************************************************************************************
  // CONFIRM ORDER FROM PROCESS ORDER SINGLE
  // *******************************************************************************************************************
  $("#process-order-single-form").on("submit", function (elem) {
    elem.preventDefault();
    let formData = new FormData(this);

    $.ajax({
      url: "php_files/order-add.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (result) {
        $("#op").html(result);
        console.log(result);
        if (result) {
          $("#orderSuccsessMassage").modal("show");
          setTimeout(function () {
            window.location.href = "orders.php";
          }, 3000);
        }
      },
    });
  });

  // *******************************************************************************************************************
  // CANCEL ORDER FROM PROCESS ORDER SINGLE
  // *******************************************************************************************************************

  $(".cansel_btn").on("click", function (elem) {
    elem.preventDefault();
    let thisElem = $(this);
    let order_id = $(this).attr("data-order-id");
    let pro_id = $(this).attr("data-pro-id");

    $.ajax({
      url: "php_files/cansel-order.php",
      type: "POST",
      data: { order_id: order_id, pro_id: pro_id },
      success: function (result) {
        // console.log(result);
        // $("#op").html(result);
        if(result == 1){
          thisElem.children(".cansel_btn_text").html("cancelled")
        }
      },
    });
  });

  // DOCUMENT READY FUNCTION END HERE
});
