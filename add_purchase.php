<?php
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");


if (!isset($_GET['productName'])) {
  header("location: select_product.php");
}
// Query to get product id from database
$productName = $_GET['productName'];

$products = $mysqli->query("SELECT products_final.product_id AS productId, 
                                   product_units.product_unit_name AS productUnitName
                            FROM products_final
                            LEFT JOIN product_units ON products_final.product_unit_id = product_units.product_unit_id
                            WHERE product_name = '$productName'");

while ($row = $products->fetch_assoc()) {
  $productID = $row['productId'];
  $productUnit = $row['productUnitName'];
}

// Query to return venue names from database
$venues = $mysqli->query("SELECT venue_name FROM venues");

// Query to return offer names from database
$offers = $mysqli->query("SELECT offer_name FROM offers");

/*Check if form submitted with  "post" method*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $productId2 = $_POST['product_id'];
  $productPrice = $_POST['product_price'];
  $dateOfPurchase = $_POST['date_of_purchase'];
  $venueName = $_POST['venue'];
  $offerName = $_POST['offer'];
  $qntItems = $_POST['num_of_items'];
  $productQuantity = $_POST['product_quantity'];


  /**TODO!!!!! When units are items shit */
  $pricePerQuantity = $productPrice / ($productQuantity * $qntItems);
  $pricePerQuantityOfItems = $productPrice / $qntItems;

  // Query to get venue id from database according to venue name
  $venueIds = $mysqli->query("SELECT venue_id FROM venues where venue_name = '$venueName'");

  while ($row3 = $venueIds->fetch_assoc()) {
    $venueId = $row3['venue_id'];
  }

  // Query to get offer id from database according to offer name
  $offerIds = $mysqli->query("SELECT offer_id FROM offers where offer_name = '$offerName'");

  while ($row3 = $offerIds->fetch_assoc()) {
    $offerId = $row3['offer_id'];
  }

  /*Query to add new purchase to the database*/
  $sql = "INSERT INTO purchases (product_id, product_price, qnt_of_product, price_per_qnt, date_of_purchase, venue_id, offer_id, number_of_items, price_per_item) 
                        VALUES ('$productId2', '$productPrice', '$productQuantity', '$pricePerQuantity', '$dateOfPurchase', '$venueId', '$offerId', '$qntItems', '$pricePerQuantityOfItems')";

  if ($mysqli->query($sql) === true) {
    header("location: show_purchases.php?message=Purchased logged successfully!");
  } else {
    $_SESSION['message'] = "New service was not added!";
    header("location: error.php?message=Fuck");
  }
}
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="src/css/navbar.css" />
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="src/js/jquery-1.4.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="src/css/style.css" />
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal custom-form" action="add_purchase.php" method="post" enctype="multipart/form-data">
  <fieldset class="myForm">
    <legend>New Purchase of: <b><u><?php echo $productName ?></u></b></legend>
    <!-- Enter Date -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_name">Date of Purchase:</label>
      <div class="col-md-4">
        <input type="date" id="date_of_purchase" name="date_of_purchase" placeholder="DATE" class="form-control input-md" required type="text">

      </div>
    </div>


    <!-- Enter Venue -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="venue">Venue:</label>
      <div class="col-md-4">
        <input list="venues" id="venue" name="venue" placeholder="Please select venue..." class="form-control input-md" required autocomplete="off" type="text">
        <datalist id="venues">
          <optgroup label="Venues">
            <?php

            while ($row2 = $venues->fetch_assoc()) {
              echo '<option value = "' . $row2["venue_name"] . '"></option>';
            }

            ?>
          </optgroup>
        </datalist>
      </div>
    </div>

    <!-- Enter Price -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_price">Product price:</label>
      <div class="col-md-4">
        <input type="number" min="0" step="any" id="product_price" name="product_price" placeholder="Please enter the price..." class="form-control input-md" required autocomplete="off">

      </div>
    </div>

    <!-- Enter Quantity of items -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="num_of_items">Number of Products:</label>
      <div class="col-md-4">
        <input type="number" min="1" id="num_of_items" name="num_of_items" placeholder="Please enter the number of products..." class="form-control input-md" required autocomplete="off">

      </div>
    </div>

    <!--TODO!!!! Disable if units=ITEM -->
    <!-- Enter Quantity -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_quantity">Product quantity in <u><?php echo $productUnit ?></u>:</label>
      <div class="col-md-4">
        <input type="number" min="0" step="any" id="product_quantity" name="product_quantity" placeholder="Please enter the quantity.." class="form-control input-md" required autocomplete="off">

      </div>
    </div>

    <!-- Enter Offer -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="offer">Offer:</label>
      <div class="col-md-4">
        <input list="offers" id="offer" name="offer" placeholder="Please select offer..." class="form-control input-md" autocomplete="off" type="text">
        <datalist id="offers">
          <optgroup label="offers">
            <?php

            while ($row2 = $offers->fetch_assoc()) {
              echo '<option value = "' . $row2["offer_name"] . '"></option>';
            }

            ?>
          </optgroup>
        </datalist>
      </div>
    </div>

    <!-- Hidden input for product ID -->
    <input type="hidden" id="product_id" name="product_id" value="<?php echo $productID ?>">

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="singlebutton"></label>
      <div class="col-md-4">
        <input type="submit" value="Add Purchase" name="modify" class="btn btn-block btn-primary" />
      </div>
    </div>

  </fieldset>
</form>