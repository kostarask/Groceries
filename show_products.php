<?php 
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");

if(isset($_GET['message'])){
  popMessage($_GET['message']);
}

 ?>

<!DOCTYPE html>
<head>
    <title>Whatever</title>
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/style.css">
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
  <div class="container">

    <h1 class= "hed">
      <span>
        Products
      </span>
    </h1>

    <div class="custom-add-form" style="">
      <form action="add_prod.php" method="post">
          <button type="submit" class="btn btn-primary">Add New Product</button>
      </form>
    </div>

    <div class = "tables tables-grid">
      <table class= "table table-sortable sticky-table row-highlighter test2">
        <thead>
            <tr>
                <th class="pre-sort" data-type = "number">Product ID</th>
                <th class="pre-sort">Product Name</th>
                <th class="pre-sort">Product Unit</th>
                <th class="pre-sort">Product Subtype</th>
                <th class="pre-sort">Product Type</th>
                <th class="pre-sort">Product Category</th>
                <th class="pre-sort">Product Tag</th>
                <th class="pre-sort" data-type = "number">Highest Price</th>
                <th class="pre-sort" data-type = "number">Lowest Price</th>
                <th class="pre-sort" data-type = "number">Average Price</th>
                <th class="pre-sort" data-type = "number">Highest Price per QNT</th>
                <th class="pre-sort" data-type = "number">Lowest Price per QNT</th>
                <th class="pre-sort" data-type = "number">Average Price per QNT</th>
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
                      <td>'.max_price($row["productId"]).' &euro; found at: '.venue_max($row["productId"]).'</td>
                      <td>'.min_price($row["productId"]).' &euro; found at: '.venue_min($row["productId"]).'</td>
                      <td>'.avg_price($row["productId"]).' &euro;</td>
                      <td>'.max_price_per($row["productId"]).' &euro;&#8725;'.$row["productUnit"].' found at: '.venue_per_max($row["productId"]).' </td>
                      <td>'.min_price_per($row["productId"]).' &euro;&#8725;'.$row["productUnit"].' found at: '.venue_per_min($row["productId"]).'</td>
                      <td>'.avg_price_per($row["productId"]).' &euro;&#8725;'.$row["productUnit"].'</td>
                  </tr>';

            }
          ?>
          </tbody>
        </table>
      </div>
  </div>
  <script src="src/js/tablesort.js" ></script>
</body>

