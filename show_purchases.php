<?php 
include("includes/header.php");
include('includes/db.php');
include("includes/functions.php");


 ?>
<!DOCTYPE html>
<head>
    <title>Whatever</title>
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/tablesort.css">
</head>

<?php 
if(isset($_GET['message'])){
    popMessage($_GET['message']);
}

$purchases = $mysqli->query("SELECT purchases.purchace_id AS purchaseId,
                                    products_final.product_name AS productName,
                                    purchases.product_price AS productPrice,
                                    purchases.date_of_purchase AS purchaseDate,
                                    venues.venue_name AS venueName,
                                    purchases.qnt_of_product AS productQuantity,
                                    purchases.price_per_qnt AS pricePerQuantity,
                                    product_tags.product_tag_name AS productTag,
                                    product_units.product_unit_name AS unitName
                            FROM products_final,purchases,venues,product_tags,product_units
                            WHERE purchases.product_id=products_final.product_id
                            AND purchases.venue_id=venues.venue_id
                            AND products_final.product_tag_id=product_tags.product_tag_id
                            AND products_final.product_unit_id=product_units.product_unit_id
                            ORDER BY date_of_purchase DESC");
?>

<body>
<h1 class= "hed">Purchases History</h1>
    <div class = "tables">
        <table class="table table-sortable">
            <thead>
                <tr>
                    <th data-type = "number">Purchase ID</th>
                    <th>Product Name</th>
                    <th data-type = "number">Product Price</th>
                    <th data-type = "date">Purchase Date</th>
                    <th>Venue</th>
                    <th data-type = "number">Quantity</th>
                    <th data-type = "number">Value per Quantity</th>
                    <th>Product Tag</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $purchases->fetch_assoc()) {

                        echo '<tr>
                                <td>'.$row["purchaseId"].'</td>
                                <td><a href= "product_history.php?prod_name='.$row["productName"].'">'.$row["productName"].'</a></td>
                                <td>'.$row["productPrice"].' &euro;</td>
                                <td>'.$row["purchaseDate"].'</td>
                                <td>'.$row["venueName"].'</td>
                                <td>'.$row["productQuantity"].' '.$row["unitName"].'</td>
                                <td>'.$row["pricePerQuantity"].' &euro; &#8725;'.' '.$row["unitName"].'</td>
                                <td>'.$row["productTag"].'</td>
                            </tr>';
                            
                    }
        
                ?>
            </tbody>
        </table>
    </div>
    <script src="src/js/tablesort.js" defer></script>
</body>