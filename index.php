<?php 
// include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");

$pieResults = $mysqli->query("SELECT SUM(product_price) AS categoryExpenditure,
                                     product_categories.category_name AS categoryName, 
                                     product_types.product_type_name AS productTypeName, 
                                     product_subtypes.product_subtype_name AS productSubtypeName, 
                                     products_final.product_name AS productName, 
                                     product_tags.product_tag_name AS productTag 
                                FROM purchases,products_final,product_categories,product_types,product_subtypes,product_tags
                                WHERE purchases.product_id=products_final.product_id
                                AND products_final.product_subtype_id=product_subtypes.product_subtype_id
                                AND product_subtypes.product_type_id=product_types.product_type_id
                                AND product_types.category_id=product_categories.category_id
                                AND products_final.product_tag_id=product_tags.product_tag_id
                                GROUP BY products_final.product_name");

$pieResults2 = $mysqli->query("SELECT SUM(product_price) AS categoryExpenditure,
                                     product_categories.category_name AS categoryName, 
                                     product_types.product_type_name AS productTypeName, 
                                     product_subtypes.product_subtype_name AS productSubtypeName, 
                                     products_final.product_name AS productName, 
                                     product_tags.product_tag_name AS productTag 
                                FROM purchases,products_final,product_categories,product_types,product_subtypes,product_tags
                                WHERE purchases.product_id=products_final.product_id
                                AND products_final.product_subtype_id='1'
                                AND product_subtypes.product_type_id=product_types.product_type_id
                                AND product_types.category_id=product_categories.category_id
                                AND products_final.product_tag_id=product_tags.product_tag_id
                                GROUP BY products_final.product_name");



 ?>

<!DOCTYPE html>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php while($row = $pieResults->fetch_assoc()){
                echo "['".$row['productName']."', ".$row['categoryExpenditure']."],";
                }
            ?>
        ]);

        var options = {
          title: 'Total per Product',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

      function drawChart2() {

        var data2 = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          ['2004',  1000.90],
          ['2005',  1170],
          ['2006',  660],
          ['2007',  1030]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('piechart2'));

        chart.draw(data2, options);
        }
      
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <div id="piechart2" style="width: 900px; height: 500px;"></div>
  </body>
</html>