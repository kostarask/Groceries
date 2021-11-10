<?php
    include("includes/header.php");
    require("includes/db.php");
    include("includes/functions.php");
    
    if(isset($_POST['date_range_picker'])){
    
        $initialDateRange = $_POST['date_range_picker'];
        $datesArray =explode(" - ",$initialDateRange);

        $php_start_date = $datesArray[0];
        $php_end_date=$datesArray[1];
        
        $startDateDb = str_replace("/","-",$datesArray[0]);
        $endDateDb = str_replace("/","-",$datesArray[1]);
        
        $startDate = date( 'd/m/Y', strtotime( $datesArray[0] ) );
        $endDate = date( 'd/m/Y', strtotime( $datesArray[1] ) );

    }else{

        $php_start_date = date('Y/m/d', strtotime("2019-01-01"));
        $php_end_date=date('Y/m/d');
        
        $startDate = date( 'd/m/Y', strtotime( $php_start_date ) );
        $startDateDb = str_replace("/","-",$php_start_date);
        
        $endDate = date('d/m/Y');
        $endDateDb = str_replace("/","-",$php_end_date);

    }

    if(isset($_POST['group_by_variable'])){

        $groupByVariable = $_POST['group_by_variable'];

    }else{

        $groupByVariable = 'productCategoryName';

    }

    switch ($groupByVariable) {
        case "productSubtypeName":
            $groupByVariableName = 'Product Subtype';
            break;
        case "productName":
            $groupByVariableName = 'Product';
            break;
        case "productTypeName":
            $groupByVariableName = 'Product Type';
            break;
        case "productCategoryName":
            $groupByVariableName = 'Product Category';
            break;
        case "venueName":
            $groupByVariableName = 'Venue';
            break;
    }

    if(isset($_GET['message'])){
        popMessage($_GET['message']);
    }
    $categories = $mysqli->query("SELECT product_subtypes.product_subtype_name AS productSubtypeName,
                                            products_final.product_name AS productName,
                                            product_types.product_type_name AS productTypeName,
                                            product_categories.category_name AS productCategoryName,
                                            venues.venue_name AS venueName,
                                            SUM(purchases.product_price) AS totalSpent
                                FROM products_final,purchases,product_subtypes,product_categories,product_types,venues
                                WHERE purchases.product_id=products_final.product_id
                                AND products_final.product_subtype_id=product_subtypes.product_subtype_id
                                AND products_final.product_subtype_id=product_subtypes.product_subtype_id
                                AND product_subtypes.product_type_id=product_types.product_type_id
                                AND product_types.category_id=product_categories.category_id
                                AND purchases.venue_id=venues.venue_id
                                AND purchases.date_of_purchase BETWEEN '$startDateDb' AND '$endDateDb'
                                GROUP BY $groupByVariable");

    
?>

<!DOCTYPE html>
<head>
    <title>Test</title>
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/style.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Euros'],
            <?php while($row2 = $categories->fetch_assoc()){
                echo "['".$row2[$groupByVariable]."', ".$row2['totalSpent']."],";
                }
            ?>
        ]);

        var options = {
          title: 'Total per <?php echo $groupByVariableName?>',
          is3D: true,
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>

    <?php
    $categories = $mysqli->query("SELECT product_subtypes.product_subtype_name AS productSubtypeName,
                                            products_final.product_name AS productName,
                                            product_types.product_type_name AS productTypeName,
                                            product_categories.category_name AS productCategoryName,
                                            venues.venue_name AS venueName,
                                            SUM(purchases.product_price) AS totalSpent
                                FROM products_final,purchases,product_subtypes,product_categories,product_types,venues
                                WHERE purchases.product_id=products_final.product_id
                                AND products_final.product_subtype_id=product_subtypes.product_subtype_id
                                AND products_final.product_subtype_id=product_subtypes.product_subtype_id
                                AND product_subtypes.product_type_id=product_types.product_type_id
                                AND product_types.category_id=product_categories.category_id
                                AND purchases.venue_id=venues.venue_id
                                AND purchases.date_of_purchase BETWEEN '$startDateDb' AND '$endDateDb'
                                GROUP BY $groupByVariable");

    ?>

    <div class="container">
		<h1 class= "hed">
			<span>
				Expences Between <u><?php echo $startDate?></u> And <u><?php echo $endDate?></u>
			</span>
		</h1>

        <div class="chart-grid" id="piechart"></div>

		<div class="date-picker-form">
            
            <form action="show_expences.php" method="post">

                <label for="date_range_picker">Date Range:</label>
                <input class="custom-input-field" type="text" name="date_range_picker" id="date_range_picker"> 

                <label for="group_by_variable">Order By:</label>
                <select class="custom-input-field" id="group_by_variable" name="group_by_variable" >
                    <option value="<?php echo $groupByVariable?>" selected hidden><?php echo $groupByVariableName?></option>
                    <option value="productCategoryName">Product Category</option>
                    <option value="productTypeName">Product Type</option>
                    <option value="productSubtypeName">Product Subtype</option>
                    <option value="productName">Product</option>
                    <option value="venueName">Venue</option>
                </select>

                <button class ="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    
		<div class = "tables tables-grid hidden-x-scroll " style="border-top-left-radius: 0px;
	border-top-right-radius: 0px;">
            <table class="table table-sortable row-highlighter sticky-table two-columns test2">
                <thead>
                    <tr>
                        <th><?php echo $groupByVariableName?></th>
                        <th>Total Money Spent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalExpences= 0;
                        while ($row = $categories->fetch_assoc()) {

                            $totalExpences += $row["totalSpent"];

                            echo '
                                <tr>
                                    <td>'.$row[$groupByVariable].'</td>
                                    <td>'.$row["totalSpent"]. '&euro;</td>
                                </tr>';
                        }        
                    ?>
                </tbody>
            </table>
        </div>
            <div class="tables test2">
            <table class="table table-sortable two-columns test2">
                <thead>
                    <tr>
                        <?php
                        echo '<th style="font-weight: bold; font-size:1.3em; text-align: right;">Total Expences:</th>';
                        echo '<th style="font-weight: bold; font-size:1.3em; text-align: left;"> '.$totalExpences.' &euro;</th>';
                        ?>
                    </tr>
                </thead>
            </table>
            
        </div>

	</div>
    <script src="src/js/tablesort.js" defer></script>
</body>

<script>

    var js_start_date= '<?php echo $php_start_date;?>';
    var js_end_date= '<?php echo $php_end_date;?>';

    $('input[name="date_range_picker"]').daterangepicker({
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