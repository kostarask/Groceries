<?php 
include("header.php");
include("src/functions.php");
include 'db.php';
 ?>
<!DOCTYPE html>
<head>
    <title>Whatever</title>
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="./src/css/tablesort.css">
</head>


    

    <?php 
               
        $products_array2 = $mysqli->query("SELECT * FROM products ORDER BY product_id");
       ?>
  <body>
  <h1 class= "hed">Fixed Table header</h1>

    <div class = "tables">
      <table class= "table table-sortable">
        <thead>
            <tr>
                <th data-type = "number">Product ID</th>
                <th>Product Name</th>
                <th>Product Unit</th>
                <th data-type = "number">Highest Price</th>
                <th data-type = "number">Lowest Price</th>
                <th data-type = "number">Average Price</th>
                <th data-type = "number">Highest Price per QNT</th>
                <th data-type = "number">Lowest Price per QNT</th>
                <th data-type = "number">Average Price per QNT</th>
            </tr>
          </thead>

        <tbody>
          
          <?php
            while ($row = $products_array2->fetch_assoc()) {
                
              echo '<tr>
                      <td>'. $row["product_id"] .'</td>
                      <td><a href= "product_history.php?prod_name='.$row["product_name"].'">'. $row["product_name"] .'</a></td>
                      <td>'.$row["units"].'</td>
                      <td>'.max_price($row["product_name"]).'&euro; found at: '.venue_max($row["product_name"]).'</td>
                      <td>'.min_price($row["product_name"]).'&euro; found at: '.venue_min($row["product_name"]).'</td>
                      <td>'.avg_price($row["product_name"]).'&euro;</td>
                      <td>'.max_price_per($row["product_name"]).'&euro;&#8725;'.$row["units"].' found at: '.venue_per_max($row["product_name"]).' </td>
                      <td>'.min_price_per($row["product_name"]).'&euro;&#8725;'.$row["units"].' found at: '.venue_per_min($row["product_name"]).'</td>
                      <td>'.avg_price_per($row["product_name"]).'&euro;&#8725;'.$row["units"].'</td>
                  </tr>';

            }
          ?>
          </tbody>
        </table>
      </div>
<script src="./src/tablesort.js" ></script>
</body>
</html>

