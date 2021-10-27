<?php 
include("includes/header.php");
include('includes/db.php');
 ?>
<!DOCTYPE html>
<head>
    <title>Whatever</title>
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/tablesort.css">
</head>

<?php 

$purchases = $mysqli->query("SELECT purchases.purchace_id,
                                    products.product_name AS productName,
                                    purchases.product_units,
                                    purchases.product_price,
                                    purchases.qnt_of_product,
                                    purchases.date_of_purchase,
                                    venues.venue_name AS venueName,
                                    purchases.price_per_qnt,
                                    product_categories.category_name AS categoryName,
                                    product_types.type_name AS typeName
                            FROM purchases
                            LEFT JOIN product_types ON purchases.product_type_id = product_types.product_type_id
                            INNER JOIN product_categories ON product_types.category_id = product_categories.category_id
                            INNER JOIN products ON purchases.product_id = products.product_id
                            INNER JOIN venues ON purchases.venue_id = venues.venue_id");
?>

<body>
<h1 class= "hed">Fixed Table header</h1>
    <div class = "tables">
        <table class="table table-sortable">
            <thead>
                <tr>
                    <th data-type = "number">Purchase ID</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Type</th>
                    <th>Units</th>
                    <th data-type = "number">Price</th>
                    <th data-type = "date">Date of Purchace</th>
                    <th>Venue</th>
                    <th data-type = "number">Quantity</th>
                    <th data-type = "number">Value per Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $purchases->fetch_assoc()) {

                        echo '<tr>
                                <td>'.$row["purchace_id"].'</td>
                                <td><a href= "product_history.php?prod_name='.$row["productName"].'">'.$row["productName"].'</a></td>
                                <td>'.$row["categoryName"].'</td>
                                <td>'.$row["typeName"].'</td>
                                <td>'.$row["product_units"].'</td>
                                <td>'.$row["product_price"].'&euro;</td>
                                <td>'.$row["date_of_purchase"].'</td>
                                <td>'.$row["venueName"].'</td>
                                <td>'.$row["qnt_of_product"].$row["product_units"].'</td>
                                <td>'.number_format(round(floatval(($row["product_price"]/$row["qnt_of_product"])),2), 2, '.', '').'&euro;&#8725;'.$row["product_units"].'</td>
                            </tr>';
                            
                    }
        
                ?>
            </tbody>
        </table>
    </div>
    <script src="./src/js/tablesort.js" defer></script>
</body>