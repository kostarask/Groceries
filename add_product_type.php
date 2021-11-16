<?php
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");
include("includes/dbInserts.php");


if (isset($_GET['message'])) {
  popMessage($_GET['message']);
}

if ((isset($_POST['product_type_name'])) && (isset($_POST['category_id']))) {

  if (checkDbForEntry('product_types', 'product_type_name', $_POST['product_type_name'])) {
    header("location:add_product_type.php?message=Product type already exists!");
  } else {
    insertEntryToTypes($_POST['product_type_name'], $_POST['category_id']);
  }
}

//Query to retrieve categories from database  
$categories = $mysqli->query("SELECT * FROM product_categories ORDER BY category_name");
?>

<!DOCTYPE html>

<head>
  <title>Add Product Subtype</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="src/css/style.css" />
  <link rel="stylesheet" type="text/css" href="src/css/navbar.css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="src/js/jquery-1.4.2.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>

  <form class="form-horizontal custom-form" action="add_product_type.php" method="post" enctype="multipart/form-data">
    <fieldset class="myForm">
      <legend>New Product Type</legend>

      <!-- Inout new type name-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="product_type_name">New Product Type Name:</label>
        <div class="col-md-4">
          <input id="product_type_name" name="product_type_name" placeholder="Please enter name..." class="form-control input-md" required="" type="text" autocomplete=off>
        </div>
      </div>

      <!--Select Category of new type-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="category_id">Category:</label>
        <div class="col-md-4">
          <select id="category_id" name="category_id" class="form-control" required>
            <option value="" disabled selected hidden>Please Choose...</option>
            <?php
            while ($row = $categories->fetch_assoc()) {
              echo '<option value = ' . $row["category_id"] . '>' . $row["category_name"] . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="singlebutton"></label>
        <div class="col-md-4">
          <input type="submit" value="Add New Product Type" name="modify" class="btn btn-block btn-primary" />
        </div>
      </div>

    </fieldset>
  </form>
</body>