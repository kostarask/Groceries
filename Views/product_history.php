<?php
include("../includes/header.php");
include("../includes/includes.php");
include("../Controllers/chartsQueries.php");

if (isset($_GET['productName'])) {
  $_GET['prod_id'] = getIdFromName($_GET['productName']);
}

if (isset($_GET['prod_id'])) {

  $chartExpencesForThisYear = chartExpencesForThisYear($_GET['prod_id']);

  $chartAvgPerYear = chartAvgPerYear($_GET['prod_id']);

  $chartTotalPerYear = chartTotalPerYear($_GET['prod_id']);

  $products_array2 = showSelectedProductQuery($_GET['prod_id']);

  while ($row2 = $products_array2->fetch_assoc()) {
    $productId = $row2['productId'];
    $productName = $row2['productName'];
    $productUnit = $row2['productUnit'];
    $productSubtype = $row2['productSubtype'];
    $productType = $row2['productType'];
    $productCategory = $row2['productCategory'];
    $productTag = $row2['productTag'];
  }
}
?>
<!DOCTYPE html>

<head>
  <title>Product Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="../src/css/style.css">
  <link rel="stylesheet" href="../src/css/product_history.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart2);



    function drawChart2() {

      var data = google.visualization.arrayToDataTable([
        ['Date', 'Price'],
        <?php while ($row2 = $chartExpencesForThisYear->fetch_assoc()) {
          echo "['" . $row2['dateOfPurchase'] . "', " . floatval($row2['price']) . "],";
        }
        ?>

      ]);

      var data2 = google.visualization.arrayToDataTable([
        ['Date', 'Total Price Per Year'],
        <?php while ($row2 = $chartTotalPerYear->fetch_assoc()) {
          echo "['" . $row2['dateOfPurchase'] . "', " . floatval($row2['price']) . "],";
        }
        ?>

      ]);

      var options = {
        title: '<?php echo $productName ?> Expences For This Year',
        curveType: 'none',
        legend: {
          position: 'bottom'
        }
      };

      var options2 = {
        title: 'Annual <?php echo $productName ?> Expences',
        curveType: 'none',
        legend: {
          position: 'bottom'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('piechart1'));
      chart.draw(data, options);
      var chart = new google.visualization.LineChart(document.getElementById('piechart2'));
      chart.draw(data2, options2);
    }
  </script>
</head>

<body>
  <div class="container grid-container-two-cols" style="grid-gap:5px;">
    <h1 class="hed grid-header-two-cols">
      <span>
        <?php echo $productName; ?>
      </span>
    </h1>

    <div class="tables-grid-two-cols">
      <table class="table test2">


        <tbody>

          <?php
          echo '<tr>';
          echo '<th data-type = "number">Product ID</th>';
          echo '<td>' . $productId . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th>Product Name</th>';
          echo '<td>' . $productName . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th>Product Unit</th>';
          echo '<td>' . $productUnit . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th>Product Subtype</th>';
          echo '<td>' . $productSubtype . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th>Product Type</th>';
          echo '<td>' . $productType . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th>Product Category</th>';
          echo '<td>' . $productCategory . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th>Product Tag</th>';
          echo '<td>' . $productTag . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th data-type = "number">Highest Price</th>';
          echo '<td>' . max_price($productId) . '&euro; found at: ' . venue_max($productId) . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th data-type = "number">Lowest Price</th>';
          echo '<td>' . min_price($productId) . '&euro; found at: ' . venue_min($productId) . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th data-type = "number">Average Price</th>';
          echo '<td>' . avg_price($productId) . '&euro;</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th data-type = "number">Highest Price per QNT</th>';
          echo '<td>' . max_price_per($productId) . '&euro;&#8725;' . $productUnit . ' found at: ' . venue_per_max($productId) . ' </td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th data-type = "number">Lowest Price per QNT</th>';
          echo '<td>' . min_price_per($productId) . '&euro;&#8725;' . $productUnit . ' found at: ' . venue_per_min($productId) . '</td>';
          echo '</tr>';
          echo '<tr>';
          echo '<th data-type = "number">Average Price per QNT</th>';
          echo '<td>' . avg_price_per($productId) . '&euro;&#8725;' . $productUnit . '</td>';
          echo '</tr>';
          ?>
        </tbody>
      </table>
    </div>
    <div class="chart-grid-two-cols" id="piechart1"></div>
    <div class="chart-grid-two-cols-2" id="piechart2"></div>
  </div>
  <script src="../src/tablesort.js"></script>
</body>

</html>