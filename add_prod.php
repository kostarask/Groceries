<?php
  include("includes/header.php");
  require("includes/db.php");
  include("includes/functions.php");

  if(isset($_GET['message'])){
    popMessage($_GET['message']);
  }

  // Function that inserts entry into Database
  function insertEntryToDatabase(){
    global $mysqli;

    if($_SERVER['REQUEST_METHOD']=='POST'){

      $product_name = $_POST['product_name'];
      $product_subtype_id = $_POST['product_subtype_id'];
      $product_unit_id = $_POST['product_unit'];
      $product_tag_id = $_POST['product_tag'];

      checkDbForEntry2('products_final','product_name', $product_name,
                      'add_prod.php?message=Error: Product type already exists!');
    }
    

    if(!($_SERVER['REQUEST_METHOD']== 'POST')){
      return;
    }

    $sql2 = "INSERT INTO products_final (product_name, product_subtype_id, product_unit_id, product_tag_id)
             VALUES ('$product_name', $product_subtype_id, $product_unit_id, $product_tag_id)";
            
      if($mysqli->query($sql2)===true){
        header("location: show_products.php?message=New Product added successfully!");
      }else{
        header("location: show_products.php?message=ERROR: New Product was not added!");
      }
  }

  insertEntryToDatabase();
  
  //Query to retrieve categories from database  
  $categories = $mysqli->query("SELECT * FROM product_categories ORDER BY category_name");

  //Query to retrieve product types from database  
  $product_types = $mysqli->query("SELECT * FROM product_types");

  //Query to retrieve product subtypes from database  
  $product_subtypes = $mysqli->query("SELECT * FROM product_subtypes");

  //Query to retrieve product units from database  
  $product_units = $mysqli->query("SELECT * FROM product_units ORDER BY product_unit_name");

  //Query to retrieve product tags from database  
  $product_tags = $mysqli->query("SELECT * FROM product_tags");

  

?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="src/css/style.css" />
<link rel="stylesheet" type="text/css" href="src/css/navbar.css" />
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="src/js/jquery-1.4.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action="add_prod.php" method="post" enctype="multipart/form-data">
<fieldset class= "myForm">
<legend>New Product Type</legend>

<!-- Inout new product name-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="product_name">New Product Name:</label>  
      <div class="col-md-4">
        <input id="product_name" name="product_name" placeholder="Please enter name..." class="form-control input-md" required="" type="text" autocomplete=off>
      </div>
  </div>

<!--Select subtype of new product-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="product_subtype_id">Product Type:</label>  
    <div class="col-md-4">
      <select id="product_subtype_id" name="product_subtype_id" class="form-control" required>
        <option value="" disabled selected hidden>Please Choose...</option>
        <?php
        // 3 Nested while loops to create 3-level optgroup with the use of &nbsp;
        // 1st while loop that creates the product category optgroups
          while($row= $categories -> fetch_assoc()){
            $temp_category_name = $row['category_name'];
            echo'<optgroup label="'.$row['category_name'].'">';

            $product_types = $mysqli->query("SELECT product_types.product_type_name AS productTypeName
                                              FROM `product_types`
                                              LEFT JOIN product_categories
                                              ON product_types.category_id = product_categories.category_id
                                              WHERE product_categories.category_name LIKE '$temp_category_name'
                                              ORDER BY productTypeName");

                      
            // 2nd while loop that creates the product type optgroups
            while($row2= $product_types -> fetch_assoc()){
              echo'<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['productTypeName'].'">';
              $temp_product_type_name = $row2['productTypeName'];

              $product_subtypes = $mysqli->query("SELECT product_subtypes.product_subtype_id AS productSubtypeId,
                                                          product_subtypes.product_subtype_name AS productSubtypeName
                                                  FROM product_subtypes
                                                  LEFT JOIN product_types
                                                  ON product_subtypes.product_type_id = product_types.product_type_id
                                                  WHERE product_types.product_type_name LIKE '$temp_product_type_name'
                                                  ORDER BY productSubtypeName");

                          
                // 3rd while loop that creates the product subtype options
                while($row3 = $product_subtypes -> fetch_assoc()){

                echo '<option value = '. $row3["productSubtypeId"] .'>&nbsp;&nbsp;&nbsp;&nbsp;'. $row3["productSubtypeName"] .'</option>';
              }

            }
            
        }


        ?>
      </select>
    </div>
  </div>

  <!--Select unit of new product-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="product_unit">Product Units:</label>  
    <div class="col-md-4">
      <select id="product_unit" name="product_unit" class="form-control" required>
        <option value="" disabled selected hidden>Please Choose...</option>
        <?php
          while($row= $product_units -> fetch_assoc()){
            echo '<option value = '. $row["product_unit_id"] .'>'. $row["product_unit_name"] .'</option>';
        }
        ?>
      </select>
    </div>
  </div>

  <!--Select tag for new product-->
  <div class="form-group">
      <label class="col-md-4 control-label" for="product_tag">Product Tag:</label>  
      <div class="col-md-4">
        <select id="product_tag" name="product_tag" class="form-control" required>
          <option value="" disabled selected hidden>Please Choose...</option>
          <?php
            while($row= $product_tags -> fetch_assoc()){
              echo '<option value = '. $row["product_tag_id"] .'>'. $row["product_tag_name"] .'</option>';
          }
          ?>
        </select>
      </div>
    </div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="submit" value="Add New Product" name="modify" class="btn btn-block btn-primary" />
  </div>
  </div>

</fieldset>
</form>
