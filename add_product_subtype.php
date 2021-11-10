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

      $product_subtype_name = $_POST['product_subtype_name'];
      $product_type_id = $_POST['product_type_id'];

      checkDbForEntry2('product_subtypes','product_subtype_name', $product_subtype_name,
                      'add_product_subtype.php?message=Error: Product subtype already exists!');
    }
    

    if(!($_SERVER['REQUEST_METHOD']== 'POST')){
      return;
    }

    $sql2 = "INSERT INTO product_subtypes (product_subtype_name, product_type_id) VALUES ('$product_subtype_name', $product_type_id)";
            
      if($mysqli->query($sql2)===true){
        header("location: show_product_subtypes.php?message=New Product Type added successfully!");
      }else{
        header("location: show_product_subtypes.php?message=ERROR: New Product Type was not added!");
      }
  }

  insertEntryToDatabase();
  
  //Query to retrieve product types from database  
  $product_types = $mysqli->query("SELECT * FROM product_types ORDER BY product_type_name");
  

?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="src/css/style.css" />
<link rel="stylesheet" type="text/css" href="src/css/navbar.css" />
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="src/js/jquery-1.4.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal custom-form" action="add_product_subtype.php" method="post" enctype="multipart/form-data">
<fieldset class= "myForm">
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
            while($row= $product_types -> fetch_assoc()){
              echo '<option value = '. $row["product_type_id"] .'>'. $row["product_type_name"] .'</option>';
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
