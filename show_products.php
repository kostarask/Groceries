<?php 
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");
 ?>
<!DOCTYPE html>
<head>
    <title>Whatever</title>
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="src/css/tablesort.css">
</head>


    

    <?php 
               
        $products_array2 = $mysqli->query("SELECT products_final.product_id AS productId,
                                                  products_final.product_name AS productName, 
                                                  product_units.product_unit_name AS productUnit,
                                                  product_subtypes.product_subtype_name AS productSubtype,
                                                  product_types.product_type_name AS productType,
                                                  product_categories.category_name AS productCategory,
                                                  product_tags.product_tag_name AS productTag
                                            FROM products_final, product_units, product_subtypes, product_types, product_categories, product_tags
                                            WHERE products_final.product_unit_id=product_units.product_unit_id
                                            AND products_final.product_subtype_id=product_subtypes.product_subtype_id
                                            AND product_subtypes.product_type_id=product_types.product_type_id
                                            AND product_types.category_id=product_categories.category_id
                                            AND products_final.product_tag_id=product_tags.product_tag_id");
       ?>
  <body>
  <h1 class= "hed">Products</h1>

    <div class = "tables">
      <table class= "table table-sortable">
        <thead>
            <tr>
                <th data-type = "number">Product ID</th>
                <th>Product Name</th>
                <th>Product Unit</th>
                <th>Product Subtype</th>
                <th>Product Type</th>
                <th>Product Category</th>
                <th>Product Tag</th>
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
                      <td>'. $row["productId"] .'</td>
                      <td><a href= "product_history.php?prod_id='.$row["productId"].'">'. $row["productName"] .'</a></td>
                      <td>'.$row["productUnit"].'</td>
                      <td>'.$row["productSubtype"].'</td>
                      <td>'.$row["productType"].'</td>
                      <td>'.$row["productCategory"].'</td>
                      <td>'.$row["productTag"].'</td>
                      <td>'.max_price($row["productId"]).'&euro; found at: '.venue_max($row["productId"]).'</td>
                      <td>'.min_price($row["productId"]).'&euro; found at: '.venue_min($row["productId"]).'</td>
                      <td>'.avg_price($row["productId"]).'&euro;</td>
                      <td>'.max_price_per($row["productId"]).'&euro;&#8725;'.$row["productUnit"].' found at: '.venue_per_max($row["productId"]).' </td>
                      <td>'.min_price_per($row["productId"]).'&euro;&#8725;'.$row["productUnit"].' found at: '.venue_per_min($row["productId"]).'</td>
                      <td>'.avg_price_per($row["productId"]).'&euro;&#8725;'.$row["productUnit"].'</td>
                  </tr>';

            }
          ?>
          </tbody>
        </table>
      </div>
<script src="src/tablesort.js" ></script>
</body>
</html>

