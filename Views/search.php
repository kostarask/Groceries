<?php
include("../includes/header.php");
include("../includes/includes.php");
include("../Controllers/searchLogic.php");

$keywords = '';
$result_count = 0;
$products_array2 = [];

if (isset($_POST['product_name']) && ($_POST['product_name'] != '')) {
  $query = searchLogic($_POST['product_name']);

  $products_array2 = $mysqli->query($query);

  $result_count = mysqli_num_rows($products_array2);
}

?>

<!DOCTYPE html>

<head>
  <title>Search Results</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../src/css/style.css">
  <link rel="stylesheet" href="../src/css/search.css">
</head>

<body>
  <div class="container">

    <h1 class="hed">
      <span>
        Search Results
      </span>
    </h1>

    <div class="custom-search">
      <p><?php echo $result_count ?> result(s) found for: <u><?php echo $keywords; ?></u></p>
      <form action="search.php" method="post" enctype="multipart/form-data" class="search-form">
        <button type="submit" class="btn btn-primary" style="margin-right:5px;">Search</button>
        <input id="product_name" name="product_name" placeholder="Search for product..." class="form-control" autocomplete="off" type="text">
      </form>
    </div>

    <div class="tables tables-grid search">
      <table class="table table-sortable sticky-table row-highlighter test2">
        <thead>
          <tr>
            <th class="pre-sort" data-type="number">Product ID</th>
            <th class="pre-sort">Product Name</th>
            <th class="pre-sort">Product Subtype</th>
          </tr>
        </thead>

        <tbody>

          <?php
          if ($result_count > 0) {
            while ($row = $products_array2->fetch_assoc()) {

              echo '<tr>
                      <td>' . $row["productId"] . '</td>
                      <td><a href= "product_history.php?prod_id=' . $row["productId"] . '">' . $row["productName"] . '</a></td>
                      <td>' . $row["productSubtype"] . '</td>
                  </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="../src/js/tablesort.js"></script>
</body>