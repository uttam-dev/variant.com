<?php require 'header.php';

if(!isset($_SESSION['ADMIN_LOGIN'])){
  header("location:index.php");
}

?>

<section id="orders" class="main_content">
  <div class="heading text_underline  ">
    all payments
  </div>

  <ul class="nav nav-tabs px-5 text-capitalize">
    <li class="nav-item mx-3 px-3 border-0">
      <button class="nav-link active text-capitalize" data-bs-toggle="tab" data-bs-target="#all" type="button"
        aria-selected="true">all</button>
    </li>
    <li class="nav-item mx-3 px-3">
      <button class="nav-link text-capitalize" data-bs-toggle="tab" data-bs-target="#paid" type="button"
        aria-selected="false">paid</button>
    </li>
    <li class="nav-item mx-3 px-3">
      <button class="nav-link text-capitalize" data-bs-toggle="tab" data-bs-target="#panding" type="button"
        aria-selected="false">panding</button>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane show active" id="all">

      <div class="content_wrapper mt-5">
        <table class="table table-striped table-hover text-capitalize">
          <thead class="thead-dark text-capitalize">
            <tr>
              <th>payment id</th>
              <th>ordr id</th>
              <th>user id</th>
              <th>total price</th>
              <th>payment method</th>
              <th>order date</th>
              <th>delivery status</th>
              <th>payment status</th>
            </tr>
          </thead>
          <tbody id="table_data">
            <?php
            $ob = new Database();
            $ob->sql("SELECT * FROM payment_tbl p INNER JOIN `order_tbl` o ON p.order_id = o.order_id");
            $res = $ob->getResult();
            $res = $res[0];

            foreach ($res as $val) {

              // DELIVERY STATUS BUTTON
              if ($val['delivery_status'] == 1) {
                $delivery_status = "<a class='btn btn-outline-success disabled'>deliverd</a>";
              } else {
                $delivery_status = "<a class='btn' >not deliverd..</a>";
              }


              // PAYMENT STATUS BUTTON
              if ($val['payment_status'] == 1) {
                $payment_status = "<a class='btn btn-outline-success disabled'>paid</a>";
              } else {
                $payment_status = "<a class='btn' >pending..</a>";
              }

              echo "
                      <tr>
                        <td>{$val['payment_id']}</td>
                        <td>{$val['order_id']}</td>
                        <td>{$val['user_id']}</td>
                        <td>{$val['total_price']}</td>
                        <td>{$val['payment_method']}</td>
                        <td>{$val['order_date']}</td>
                        <td>{$delivery_status}</td>
                        <td>{$payment_status}</td>
                    </tr>
                      ";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="tab-pane" id="paid">
      <div class="content_wrapper mt-5">
        <table class="table table-striped table-hover text-capitalize">
          <thead class="thead-dark text-capitalize">
            <tr>
              <th>payment id</th>
              <th>ordr id</th>
              <th>user id</th>
              <th>total price</th>
              <th>payment method</th>
              <th>order date</th>
              <th>delivery status</th>
              <th>payment status</th>
            </tr>
          </thead>
          <tbody id="table_data">
            <?php
            $ob = new Database();
            $ob->sql("SELECT * FROM payment_tbl p INNER JOIN `order_tbl` o ON p.order_id = o.order_id WHERE payment_status = 1");
            $res = $ob->getResult();
            $res = $res[0];

            foreach ($res as $val) {

              // DELIVERY STATUS BUTTON
              if ($val['delivery_status'] == 1) {
                $delivery_status = "<a class='btn btn-outline-success disabled'>deliverd</a>";
              } else {
                $delivery_status = "<a class='btn' >not deliverd..</a>";
              }


              // PAYMENT STATUS BUTTON
              if ($val['payment_status'] == 1) {
                $payment_status = "<a class='btn btn-outline-success disabled'>paid</a>";
              } else {
                $payment_status = "<a class='btn' >pending..</a>";
              }

              echo "
                      <tr>
                        <td>{$val['payment_id']}</td>
                        <td>{$val['order_id']}</td>
                        <td>{$val['user_id']}</td>
                        <td>{$val['total_price']}</td>
                        <td>{$val['payment_method']}</td>
                        <td>{$val['order_date']}</td>
                        <td>{$delivery_status}</td>
                        <td>{$payment_status}</td>
                    </tr>
                      ";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="tab-pane" id="panding">

      <div class="content_wrapper mt-5">
        <table class="table table-striped table-hover text-capitalize">
          <thead class="thead-dark text-capitalize">
            <tr>
              <th>payment id</th>
              <th>ordr id</th>
              <th>user id</th>
              <th>total price</th>
              <th>payment method</th>
              <th>order date</th>
              <th>delivery status</th>
              <th>payment status</th>
            </tr>
          </thead>
          <tbody id="table_data">
            <?php
            $ob = new Database();
            $ob->sql("SELECT * FROM payment_tbl p INNER JOIN `order_tbl` o ON p.order_id = o.order_id WHERE payment_status = 0");
            $res = $ob->getResult();
            $res = $res[0];

            if(empty($res)){
              echo "<tr>
              <td colspan='100%' style='color:red; font-size:1.3rem;'>no records found ...</td>
              </tr>";
            }
            foreach ($res as $val) {

              // DELIVERY STATUS BUTTON
              if ($val['delivery_status'] == 1) {
                $delivery_status = "<a class='btn btn-outline-success disabled'>deliverd</a>";
              } else {
                $delivery_status = "<a class='btn' >not deliverd..</a>";
              }


              // PAYMENT STATUS BUTTON
              if ($val['payment_status'] == 1) {
                $payment_status = "<a class='btn btn-outline-success disabled'>paid</a>";
              } else {
                $payment_status = "<a class='btn' >pending..</a>";
              }

              echo "
                      <tr>
                        <td>{$val['payment_id']}</td>
                        <td>{$val['order_id']}</td>
                        <td>{$val['user_id']}</td>
                        <td>{$val['total_price']}</td>
                        <td>{$val['payment_method']}</td>
                        <td>{$val['order_date']}</td>
                        <td>{$delivery_status}</td>
                        <td>{$payment_status}</td>
                    </tr>
                      ";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>



  </div>

</section>
</header>
<?php
require 'footer.php';
?>
</body>

</html>