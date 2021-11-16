<?php
include("includes/header.php");
include('includes/db.php');
include("includes/functions.php");
include("includes/dbQueries.php");

if (isset($_GET['message'])) {
    popMessage($_GET['message']);
}

//Create initial starting and ending date
$php_start_date = date('Y/m/d', strtotime("2019-01-01"));
$php_end_date = date('Y/m/d');

$startDate = date('d/m/Y', strtotime($php_start_date));
$startDateDb = str_replace("/", "-", $php_start_date);

$endDate = date('d/m/Y');
$endDateDb = str_replace("/", "-", $php_end_date);

// Update starting and ending dates when selected in form
if (isset($_POST['date_range_picker'])) {

    $initialDateRange = $_POST['date_range_picker'];
    $datesArray = explode(" - ", $initialDateRange);

    $php_start_date = $datesArray[0];
    $startDate = date('d/m/Y', strtotime($datesArray[0]));
    $startDateDb = str_replace("/", "-", $datesArray[0]);

    $php_end_date = $datesArray[1];
    $endDate = date('d/m/Y', strtotime($datesArray[1]));
    $endDateDb = str_replace("/", "-", $datesArray[1]);
}

$purchases = showPurchasesQuery($startDateDb, $endDateDb)
?>

<!DOCTYPE html>

<head>
    <title>Purchases</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body>
    <div class="container">

        <h1 class="hed">
            <span>
                Purchases History
            </span>
        </h1>

        <div class="custom-add-form">
            <!-- TODO Incorporate Date Range picker-->
            <form action="show_purchases.php" method="post">
                <label for="date_range_picker">Date Range:</label>
                <input class="custom-input-field" type="text" name="date_range_picker" id="date_range_picker">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="tables tables-grid">
            <table class="table table-sortable sticky-table row-highlighter test2">
                <thead>
                    <tr>
                        <th data-type="number" class="pre-sort">Purchase ID</th>
                        <th class="pre-sort">Product Name</th>
                        <th class="pre-sort" data-type="number">Product Price</th>
                        <th class="pre-sort" data-type="date">Purchase Date</th>
                        <th class="pre-sort">Venue</th>
                        <th class="pre-sort" data-type="number">Quantity</th>
                        <th class="pre-sort" data-type="number">Value per Quantity</th>
                        <th class="pre-sort" data-type="number">Items Purchased</th>
                        <th class="pre-sort" data-type="number">Price Per Item</th>
                        <th class="pre-sort">Offer</th>
                        <th class="pre-sort">Product Tag</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $purchases->fetch_assoc()) {

                        echo '<tr>
                                    <td>' . $row["purchaseId"] . '</td>
                                    <td><a href= "product_history.php?prod_id=' . $row["productId"] . '">' . $row["productName"] . '</a></td>
                                    <td>' . $row["productPrice"] . ' &euro;</td>
                                    <td>' . $row["purchaseDate"] . '</td>
                                    <td>' . $row["venueName"] . '</td>
                                    <td>' . $row["productQuantity"] . ' ' . $row["unitName"] . '</td>
                                    <td>' . $row["pricePerQuantity"] . ' &euro; &#8725;' . ' ' . $row["unitName"] . '</td>
                                    <td>' . $row["munOfItems"] . '</td>
                                    <td>' . $row["pricePerItem"] . ' &euro; &#8725; item</td>
                                    <td>' . $row["offerName"] . '</td>
                                    <td>' . $row["productTag"] . '</td>
                                </tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="src/js/tablesort.js" defer></script>
</body>

<script>
    var js_start_date = '<?php echo $php_start_date; ?>';
    var js_end_date = '<?php echo $php_end_date; ?>';

    $('input[name="date_range_picker"]').daterangepicker({
        "drops": "up",
        "showDropdowns": true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        },
        "locale": {
            "format": "YYYY/MM/DD",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        },
        "startDate": js_start_date,
        "endDate": js_end_date
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY/MM/DD') + ' to ' + end.format('YYYY/MM/DD') + ' (predefined range: ' + label + ')');
    });
</script>