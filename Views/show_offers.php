<?php
include("../includes/header.php");
include("../includes/includes.php");

if (isset($_GET['message'])) {
    popMessage($_GET['message']);
}

$offers = queryAll("offers");
?>
<!DOCTYPE html>

<head>
    <title>Offers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <div class="container">

        <h1 class="hed">
            <span>
                Offers
            </span>
        </h1>

        <div class="custom-add-form">
            <form action="add_offer.php" method="post">
                <button type="submit" class="btn btn-primary">Add New Offer</button>
            </form>
        </div>

        <div class="tables tables-grid">
            <table class="table table-sortable sticky-table row-highlighter two-columns">
                <thead>
                    <tr>
                        <th class="pre-sort" data-type="number">Offer ID</th>
                        <th class="pre-sort">Offer Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $offers->fetch_assoc()) {

                        echo '
                                <tr>
                                    <td>' . $row["offer_id"] . '</td>
                                    <td>' . $row["offer_name"] . '</td>
                                </tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../src/js/tablesort.js" defer></script>
</body>