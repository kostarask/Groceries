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
    <link rel="stylesheet" href="src/css/style.css">
</head>

<?php 
if(isset($_GET['message'])){
    popMessage($_GET['message']);
}

$categories = $mysqli->query("SELECT * FROM venues");

?>

<body>
    <div class="container">
        <h1 class= "hed">
            <span>
                Venues
            </span>
        </h1>

        <div class="custom-add-form">
            <form action="add_venue.php" method="get">
                <button type="submit">Add New Venue</button>
            </form>
        </div>

        <div class = "tables tables-grid">
            <table class="table table-sortable two-columns">
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
    </div>
    <script src="./src/js/tablesort.js" defer></script>
</body>