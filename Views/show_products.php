<?php
include("../includes/header.php");
require("../includes/db.php");
include("../includes/functions.php");
include("../includes/dbQueries.php");

if (isset($_GET['message'])) {
  popMessage($_GET['message']);
}

$products = showProductsQuery();
?>

<!DOCTYPE html>

<head>
  <title>Products</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
  <div class="container">

    <h1 class="hed">
      <span>
        Products
      </span>
    </h1>

    <div class="custom-add-form">
      <form action="add_prod.php" method="post">
        <button type="submit" class="btn btn-primary">Add New Product</button>
      </form>
    </div>

    <div class="tables tables-grid">
      <table class="table table-sortable sticky-table row-highlighter test2">
        <thead>
          <tr>
            <th class="pre-sort" data-type="number">Product ID</th>
            <th class="pre-sort">Product Name</th>
            <th class="pre-sort">Product Unit</th>
            <th class="pre-sort">Product Subtype</th>
            <th class="pre-sort">Product Type</th>
            <th class="pre-sort">Product Category</th>
            <th class="pre-sort">Product Tag</th>
            <th class="pre-sort" data-type="number">Highest Price</th>
            <th class="pre-sort" data-type="number">Lowest Price</th>
            <th class="pre-sort" data-type="number">Average Price</th>
            <th class="pre-sort" data-type="number">Highest Price per QNT</th>
            <th class="pre-sort" data-type="number">Lowest Price per QNT</th>
            <th class="pre-sort" data-type="number">Average Price per QNT</th>
          </tr>
        </thead>

        <tbody>

          <?php
          while ($row = $products->fetch_assoc()) {

            echo '<tr>
                      <td>' . $row["productId"] . '</td>
                      <td><a href= "product_history.php?prod_id=' . $row["productId"] . '">' . $row["productName"] . '</a></td>
                      <td>' . $row["productUnit"] . '</td>
                      <td>' . $row["productSubtype"] . '</td>
                      <td>' . $row["productType"] . '</td>
                      <td>' . $row["productCategory"] . '</td>
                      <td>' . $row["productTag"] . '</td>
                      <td>' . max_price($row["productId"]) . ' &euro; found at: ' . venue_max($row["productId"]) . '</td>
                      <td>' . min_price($row["productId"]) . ' &euro; found at: ' . venue_min($row["productId"]) . '</td>
                      <td>' . avg_price($row["productId"]) . ' &euro;</td>
                      <td>' . max_price_per($row["productId"]) . ' &euro;&#8725;' . $row["productUnit"] . ' found at: ' . venue_per_max($row["productId"]) . ' </td>
                      <td>' . min_price_per($row["productId"]) . ' &euro;&#8725;' . $row["productUnit"] . ' found at: ' . venue_per_min($row["productId"]) . '</td>
                      <td>' . avg_price_per($row["productId"]) . ' &euro;&#8725;' . $row["productUnit"] . '</td>
                  </tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="../src/js/tablesort.js"></script>
</body>