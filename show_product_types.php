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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/tablesort.css">
</head>

<?php 
if(isset($_GET['message'])){
    popMessage($_GET['message']);
}

$categories = $mysqli->query(" SELECT product_types.product_type_id AS productID,
                                     product_types.product_type_name AS productTypeName, 
                                     product_categories.category_name AS categoryName
                                FROM product_types 
                                LEFT JOIN product_categories ON product_types.category_id = product_categories.category_id");

?>

<body>
<h1 class= "hed">Product Types</h1>
    <div class = "tables">
        <table class="table table-sortable">
            <thead>
                <tr>
                    <th data-type = "number">Product Type ID</th>
                    <th>Product Type Name</th>
                    <th>Product Type Category</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $categories->fetch_assoc()) {

                        echo '
                            <tr>
                                <td>'.$row["productID"].'</td>
                                <td>'.$row["productTypeName"].'</td>
                                <td>'.$row["categoryName"].'</td>
                            </tr>';
                    }
        
                ?>
            </tbody>
        </table>
    </div>
    <script src="./src/js/tablesort.js" defer></script>
</body>