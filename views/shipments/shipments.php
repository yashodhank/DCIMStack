<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DCIMStack</title>
    <?php include 'libraries/css.php'; ?>
  </head>

  <body>

    <?php include 'libraries/header.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <?php include 'libraries/sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Shipments <div class='pull-right'><button type="button" class='btn btn-primary' data-toggle="modal" data-target="#add_shipment"><img src='assets/img/add.png'> Add</a></button></div></h1>
          <?php
            include 'config/db.php';
            $sql = "SELECT * FROM `shipments`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table' id='search_table'>";
                echo "<thead>";
                echo "<tr>";
                    echo "<th>Tracking ID</th>";
                    echo "<th>Courier</th>";
                    echo "<th>Delivery ETA</th>";
                    echo "<th>Status</th>";
                    echo "<th><center>Manage</center></th>";
                echo "</tr>";
                echo "</thead>";
                while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                      echo "<td>". $row['tracking_id'] ."</td>";
                      echo "<td>". $row["shipping_courier"]."</td>";
                      echo "<td>". $row["delivery_eta"]."</td>";
                      echo "<td>". $row["delivery_status"]."</td>";
                      echo "<td><center>Manage</center></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
          ?>
        </div>
      </div>
    </div>

    <!-- Add Shipment Modal -->
    <div id="add_shipment" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><img src='assets/img/lorry_add.png'> Add Shipment</h4>
          </div>
          <div class="modal-body">
            <form action="add_shipment_db.php" id="add_hdds" method="post">
              <label>Tracking ID</label>
              <input type="text" class="form-control" name="tracking_id" placeholder="Tracking ID" required>
              <label>Shipping Courier</label>
              <input type="text" class="form-control" name="shipping_courier" placeholder="Eg, UPS, FedEX etc" required>
              <label>Delivery ETA</label>
              <input type="text" class="form-control" name="delivery_eta" placeholder="Eg: 02/10/2016" required>
              <label>Delivery Status</label>
              <select class="form-control" name="delivery_status">
                <option value="Waiting For Dispatch">Waiting For Dispatch</option>
                <option value="Dispatched">Dispatched</option>
                <option value="In-Transit">In-Transit</option>
                <option value="Out For Delivery">Out For Delivery</option>
                <option value="Delivered">Delivered</option>
              </select>
          </form>
          </div>
          <div class="modal-footer">
            <input type="submit" form="add_hdds" class="btn btn-primary">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include 'libraries/js.php'; ?>
  </body>
</html>
