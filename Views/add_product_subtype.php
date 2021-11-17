<?php
include("../includes/header.php");
require("../includes/db.php");
include("../includes/functions.php");
include("../includes/dbInserts.php");


if (isset($_GET['message'])) {
  popMessage($_GET['message']);
}

if ((isset($_POST['product_subtype_name'])) && (isset($_POST['product_type_id']))) {

  if (checkDbForEntry('product_subtypes', 'product_subtype_name', $_POST['product_subtype_name'])) {
    header("location:add_product_subtype.php?message=Product subtype already exists!");
  } else {
    insertEntryToSubtypes($_POST['product_subtype_name'], $_POST['product_type_id']);
  }
}

//Query to retrieve product types from database  
$product_types = $mysqli->query("SELECT * FROM product_types ORDER BY product_type_name");
?>
<!DOCTYPE html>

<head>
  <title>Add Product Subtype</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="../src/css/style.css" />
  <link rel="stylesheet" type="text/css" href="../src/css/navbar.css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="../src/js/jquery-1.4.2.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>
  <form class="form-horizontal custom-form" action="add_product_subtype.php" method="post" enctype="multipart/form-data">
    <fieldset class="myForm">
      <legend>New Product Subtype</legend>

      <!-- Inout new type name-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="product_subtype_name">New Product Subtype Name:</label>
        <div class="col-md-4">
          <input id="product_subtype_name" name="product_subtype_name" placeholder="Please enter name..." class="form-control input-md" required="" type="text" autocomplete=off>
        </div>
      </div>

      <!--Select Type of new subtype-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="product_type_id">Product Type:</label>
        <div class="col-md-4">
          <select id="product_type_id" name="product_type_id" class="form-control" required>
            <option value="" disabled selected hidden>Please Choose...</option>
            <?php
            while ($row = $product_types->fetch_assoc()) {
              echo '<option value = ' . $row["product_type_id"] . '>' . $row["product_type_name"] . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="singlebutton"></label>
        <div class="col-md-4">
          <input type="submit" value="Add New Product Subtype" name="modify" class="btn btn-block btn-primary" />
        </div>
      </div>

    </fieldset>
  </form>
</body>