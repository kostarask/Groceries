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
    <link rel="stylesheet" href="src/css/tablesort.css">
</head>

<?php 
if(isset($_GET['message'])){
    popMessage($_GET['message']);
}

$categories = $mysqli->query("SELECT * FROM venues");

?>

<body>
<h1 class= "hed">Venues</h1>
    <div class = "tables">
        <table class="table table-sortable">
            <thead>
                <tr>
                    <th data-type = "number">Venue ID</th>
                    <th>Venue Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $categories->fetch_assoc()) {

                        echo '
                            <tr>
                                <td>'.$row["venue_id"].'</td>
                                <td>'.$row["venue_name"].'</td>
                            </tr>';
                    }
        
                ?>
            </tbody>
        </table>
    </div>
    <script src="./src/js/tablesort.js" defer></script>
</body>