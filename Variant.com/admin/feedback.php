<?php 
require 'header.php';


if(!isset($_SESSION['ADMIN_LOGIN'])){
    header("location:index.php");
}


if (isset($_GET['type']) && $_GET['type'] == "delete") {
    $feed_id = $_GET['feed_id'];
    $ob = new Database();

        $ob->delete("feedback_tbl", "feed_id =" . $feed_id);
        $result = $ob->getResult();
}

?>
<section id="cate" class="main_content">
    <div class="heading text_underline  ">
        all feedback's
    </div>
    <div class="d-flex justify-content-end container">
            <input id="search_input" type="text" class="form-control d-inline w-25" placeholder="search order">
            <button id="search_btn" class="btn btn-dark d-inline ml-3">search</button>
        </div>

        <div class="content_wrapper mt-5">
            <table class="table table-striped table-hover text-capitalize">
                <thead class="thead-dark text-capitalize">
                    <tr>
                        <th>feedback id</th>
                        <th>email</th>
                        <th>meassage</th>
                        <th>post date</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="table_data">

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
                        url: "php_action_files/feedback.php",
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