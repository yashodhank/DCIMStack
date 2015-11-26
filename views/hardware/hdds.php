<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DCIMStack</title>
    <?php 
    include 'libraries/css.php'; 
    //error_reporting(-1);
    //ini_set('display_errors', 'On');
    ?>
  </head>

  <body>

    <?php include 'libraries/header.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <?php include 'libraries/sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">HDDs</h1>
          <?php
            include 'config/db.php';
            $sql = "SELECT * FROM `devices` WHERE `device_type`='SSD' OR `device_type`='SATA' OR `device_type`='SAS'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table' id='search_table'>";
                echo "<thead>";
                echo "<tr>";
                  echo "<th>Vendor</th>";
                  echo "<th>Type</th>";
                  echo "<th>Physical Label</th>";
                  echo "<th>Capacity</th>";
                  echo "<th>Serial #</th>";
                  echo "<th><center>Manage</center></th>";
                echo "</tr>";
                echo "</thead>";
                while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                      echo "<td>". $row["device_brand"]."</td>";
                      echo "<td>". $row["device_type"]."</td>";
                      echo "<td>". $row["device_label"]."</td>";
                      echo "<td>". $row["device_capacity"]."</td>";
                      echo "<td>". $row["device_serial"]."</td>";
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
        
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include 'libraries/js.php'; ?>
  </body>
</html>