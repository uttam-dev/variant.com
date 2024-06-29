<?php require 'header.php';


if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}


if (
    isset($_GET['type']) && $_GET['type'] != ""
    && isset($_GET['user_id']) && $_GET['user_id'] != ""
) {

    $type = mysqli_escape_string($conn, $_GET['type']);
    $user_id = mysqli_escape_string($conn, $_GET['user_id']);

    $ob = new Database();

    if ($type == "status") {
        if (isset($_GET['operation']) && $_GET['operation'] != "") {
            if ($_GET['operation'] == "active") {
                $ob->sql("UPDATE user_tbl SET active_status = 1 WHERE user_id = " . $user_id);
            } else if ($_GET['operation'] == "blocked") {
                $ob->sql("UPDATE user_tbl SET active_status = 0 WHERE user_id = " . $user_id);
            }
        }
    }

    if ($type == "delete") {

        $ob->delete("user_tbl", "user_id=" . $user_id);
        $result = $ob->getResult();
    }

}
?>

<section id="cate" class="main_content">
    <div class="heading text_underline  ">
        all users
    </div>
    <div class="d-flex justify-content-end container">
            <input id="search_input" type="text" class="form-control d-inline w-25" placeholder="search order">
            <button id="search_btn" class="btn btn-dark d-inline ml-3">search</button>
        </div>

        <div class="content_wrapper mt-5">
            <table class="table table-striped table-hover text-capitalize">
                <thead class="thead-dark text-capitalize">
                    <tr>
                        <th>user id</th>
                        <th>user full name</th>
                        <th>email</th>
                        <th>phone no</th>
                        <th>registration date</th>
                        <th>active status</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="table_data" class="font_rob">

                </tbody>
            </table>
            
        </div>
    </div>
    <script>
        $(document).ready(function () {

            let search_input = $("#search_input");

            searchData()

            search_input.keyup(function () {
                searchData($(this).val().trim().toLowerCase())
            })

            $("#search_btn").on("click", function () {
                searchData($("#search_input").val().trim().toLowerCase());
            })

            function searchData(input="") {
                if (input != " ") {
                    $.ajax({
                        url: "php_action_files/users.php",
                        type: 'POST',
                        data: { input: input },
                        success: function (result) {
                            $("#table_data").html(result);
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