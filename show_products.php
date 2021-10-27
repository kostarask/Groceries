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

$categories = $mysqli->query(" SELECT products_final.product_name AS productName,
                                        products_final.product_id AS productId,
                                        product_subtypes.product_subtype_name AS productSubtype,
                                        product_types.product_type_name AS productType,
                                        product_categories.category_name AS productCategory,
                                        product_units.product_unit_name AS productUnits,
                                        product_tags.product_tag_name AS productTag
                                FROM products_final,product_subtypes,product_types,product_categories,product_units,product_tags
                                WHERE products_final.product_subtype_id=product_subtypes.product_subtype_id
                                AND product_subtypes.product_type_id=product_types.product_type_id
                                AND product_types.category_id=product_categories.category_id
                                AND products_final.product_unit_id=product_units.product_unit_id
                                AND products_final.product_tag_id=product_tags.product_tag_id");

?>

<body>
<h1 class= "hed">Products</h1>
    <div class = "tables">
        <table class="table table-sortable">
            <thead>
                <tr>
                    <th data-type = "number">Product ID</th>
                    <th>Product Name</th>
                    <th>Product SUBype</th>
                    <th>Product Type</th>
                    <th>Product Category</th>
                    <th>Product Units </th>
                    <th>Product Tag</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $categories->fetch_assoc()) {

                        echo '
                            <tr>
                                <td>'.$row["productId"].'</td>
                                <td>'.$row["productName"].'</td>
                                <td>'.$row["productSubtype"].'</td>
                                <td>'.$row["productType"].'</td>
                                <td>'.$row["productCategory"].'</td>
                                <td>'.$row["productUnits"].'</td>
                                <td>'.$row["productTag"].'</td>
                            </tr>';
                    }
        
                ?>
            </tbody>
        </table>
    </div>
    <script src="src/js/tablesort.js" defer></script>
</body>