<?php 
//include("header.php");
include 'db.php';
 ?>
<!DOCTYPE html>
<head>
    <title>Whatever</title>
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href=".src\js\tablesort.js">
</head>

<?php 
$prod = $_GET['prod_name'];
$purchases = $mysqli->query("SELECT * FROM purchases WHERE product_name = '$prod' ORDER BY purchace_id");
?>

<body>
    <div class = "tables">
        <table class="table table-sortable">
            <thead>
                <tr>
                    <th data-type = "number">Purchase ID</th>
                    <th>Product Name</th>
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
                                <td>'.$row["product_name"].'</td>
                                <td>'.$row["product_units"].'</td>
                                <td>'.$row["product_price"].'&euro;</td>
                                <td>'.$row["date_of_purchase"].'</td>
                                <td>'.$row["venue"].'</td>
                                <td>'.$row["qnt_of_product"].$row["product_units"].'</td>
                                <td>'.number_format(round(floatval(($row["product_price"]/$row["qnt_of_product"])),2), 2, '.', '').'&euro;&#8725;'.$row["product_units"].'</td>
                            </tr>';
                            
                    }
        
                ?>
            </tbody>
        </table>
    </div>
    <script src="./src/tablesort.js" defer></script>
</body>