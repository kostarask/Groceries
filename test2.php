<?php

if(isset($_POST['date_range_picker'])){
    echo $value = $_POST['date_range_picker'];
    $dates =explode(" - ",$_POST['date_range_picker']);
    
}else{
    $value="2021/01/01 - 2021/11/07";
    $dates =explode(" - ",$value);
}
echo $value;
echo '<br>';
echo '<br>';
echo $php_start_date = $dates[0];
echo '<br>';
echo $php_end_date=$dates[1];
echo '<br>';
echo '<br>';
echo str_replace("/","-",$dates[1]);




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
</head>

<body>
    
    <form action="test2.php" method="post">

                <label for="date_range_picker">Start Date:</label>
                <input type="text" name="date_range_picker" id="date_range_picker" ">
                

               

                <button type="submit">Submit</button>
            </form>

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
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
