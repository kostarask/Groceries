<?php
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");

if(isset($_GET['message'])){
    popMessage($_GET['message']);
}

if($_SERVER['REQUEST_METHOD']=='POST'){

    $product_name = $_POST['product_name'];

    if(checkDbForEntrySimple('products_final', 'product_name', $product_name)){
      header("location: add_purchase.php?productName=$product_name");
    }else{
      header("location: select_product.php?message=Error: Product does not exist!");
    }
}

//Query that gets all data from products table
$products = $mysqli->query("SELECT products_final.product_name AS productName, 
                                   product_subtypes.product_subtype_name AS productSubtype,
                                   product_types.product_type_name AS productType,
                                   product_categories.category_name AS productCategory,
                                   product_units.product_unit_name AS productUnits,
                                   product_tags.product_tag_name AS productTag
                             FROM products_final,product_subtypes,product_types,product_categories,product_units,product_tags
                             WHERE products_final.product_subtype_id=product_subtypes.product_subtype_id
                             AND product_subtypes.product_type_id=product_types.product_type_id
                             AND product_types.category_id=product_categories.category_id
                             AND products_final.product_unit_id=product_units.product_unit_id
                             AND products_final.product_tag_id=product_tags.product_tag_id");
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="src/css/style.css" />
<link rel="stylesheet" type="text/css" href="src/css/navbar.css" />
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="src/js/jquery-1.4.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action="select_product.php" method="post" enctype="multipart/form-data">
<fieldset class= "myForm">
<legend>New Category</legend>

<!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="product_name">Select Product:</label>  
    <div class="col-md-4">
    <input list = "products" id="product_name" name="product_name" placeholder="Please add name..." class="form-control input-md" required autocomplete="off" type="text">
    <datalist id="products">
        <optgroup label= "Products">
        <?php

          while($row = $products -> fetch_assoc()){
              echo '<option value = "'.$row["productName"].'">'.$row["productSubtype"].', '.$row["productType"].', '.$row["productCategory"].', '.$row["productTag"].'</option>';
          }

        ?>
        </optgroup>
    </datalist>
    </div>
  </div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="submit" value="Continue to Purchase" name="modify" class="btn btn-block btn-primary" />
  </div>
  </div>

</fieldset>
</form>
