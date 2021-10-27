<?php
include("header.php");
require("db.php");
include("src/functions.php");

if(isset($_GET['message'])){
    popMessage($_GET['message']);
}

// Checks if posted category already exists
if($_SERVER['REQUEST_METHOD']== 'POST'){

    $category_name = $_POST['category'];

    if(checkDbForEntry('product_categories','category_name', $category_name)){
        unset($_SERVER['REQUEST_METHOD']);
        // unset($_POST['category']);
        header("location: add_product_category.php?message=Error: Category already exists!");
    }
}

// Function that inserts entry into Database
function insertEntryToDatabase(){
  global $mysqli;
  
  
  if(!($_SERVER['REQUEST_METHOD']== 'POST')){
    return;
  }

    $category_name = $_POST['category'];
  

  $sql2 = "INSERT INTO product_categories (category_name) VALUES ('$category_name')";
          
    if($mysqli->query($sql2)===true){
      header("location: product_categories.php?message=New category added successfully!");
    }else{
      header("location: product_categories.php?message=ERROR: New category was not added!");
    }
}

insertEntryToDatabase();
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="src/css/style.css" />
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="src\js\jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="src\js\jquery.autocomplete.js"></script>
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action="add_product_category.php" method="post" enctype="multipart/form-data">
<fieldset class= "myForm">
<legend>New Category</legend>

<!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="category">New Category Name:</label>  
      <div class="col-md-4">
      <input id="category" name="category" placeholder="Category" class="form-control input-md" required="" type="text">
      </div>
    </div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="submit" value="Add New Product Category" name="modify" class="btn btn-block btn-primary" />
  </div>
  </div>

</fieldset>
</form>
