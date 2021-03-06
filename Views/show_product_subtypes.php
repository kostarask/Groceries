<?php
include("../includes/header.php");
include("../includes/includes.php");

if (isset($_GET['message'])) {
    popMessage($_GET['message']);
}

$subtypes = showSubtypesQuery();

?>
<!DOCTYPE html>

<head>
    <title>Product Subtypes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<?php

?>

<body>
    <div class="container">
        <h1 class="hed">
            <span>
                Product Subtypes
            </span>
        </h1>

        <div class="custom-add-form">
            <form action="add_product_subtype.php" method="post">
                <button type="submit" class="btn btn-primary">Add New Product Subtype</button>
            </form>
        </div>


        <div class="tables tables-grid">
            <table class="table table-sortable sticky-table row-highlighter">
                <thead>
                    <tr>
                        <th class="pre-sort" data-type="number">Product Subtype ID</th>
                        <th class="pre-sort">Product Subtype Name</th>
                        <th class="pre-sort">Product Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $subtypes->fetch_assoc()) {
                        echo '
                                <tr>
                                    <td>' . $row["productSubtypeID"] . '</td>
                                    <td>' . $row["productSubTypeName"] . '</td>
                                    <td>' . $row["productTypeName"] . '</td>
                                </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../src/js/tablesort.js" defer></script>
</body>