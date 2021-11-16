<?php
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");
include("includes/dbQueries.php");

if (isset($_GET['message'])) {
    popMessage($_GET['message']);
}

$types = showTypesQuery();
?>

<!DOCTYPE html>

<head>
    <title>Product Types</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body>
    <div class="container">
        <h1 class="hed">
            <span>
                Product Types
            </span>
        </h1>

        <div class="custom-add-form">
            <form action="add_product_type.php" method="post">
                <button type="submit" class="btn btn-primary">Add New Product Type</button>
            </form>
        </div>

        <div class="tables tables-grid">
            <table class="table table-sortable sticky-table row-highlighter test2">
                <thead>
                    <tr>
                        <th class="pre-sort" data-type="number">Product Type ID</th>
                        <th class="pre-sort">Product Type Name</th>
                        <th class="pre-sort">Product Type Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $types->fetch_assoc()) {

                        echo '
                                <tr>
                                    <td>' . $row["productID"] . '</td>
                                    <td>' . $row["productTypeName"] . '</td>
                                    <td>' . $row["categoryName"] . '</td>
                                </tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="src/js/tablesort.js" defer></script>
</body>