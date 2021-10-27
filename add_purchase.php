<?php
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");


// if(!isset($_GET['message'])){
//   header("location: select_product.php?message=Please select a product...");
// }
// // Query to get product id from database
// $productName = $_GET['message'];

// $products = $mysqli->query("SELECT product_id FROM products_final WHERE product_name LIKE '$productName'");

// while ($row = $products->fetch_assoc()) {
//   $productID = $row['product_id'];
// }

$productName="Old Holborn 40g";


/*Check if form submitted with  "post" method*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $product_name = $_POST['q'];
  $units = $_POST['units'];
  $price = $_POST['product_price'];
  $date = $_POST['date_of'];
  $venue = $_POST['q2'];
  $qnt = $_POST['product_quantity'];
  $prc_per_qnt = $price/$qnt;
    

  /*Query to add new purchase to the database*/
  $sql = "INSERT INTO purchases (product_name, product_units, product_price, date_of_purchase, venue, qnt_of_product, price_per_qnt)"
      . "VALUES ('$product_name', '$units', '$price', '$date', '$venue', '$qnt', '$prc_per_qnt')";

          if($mysqli->query($sql)===true){
      $_SESSION['message']= "New service added successfully!";
      header("location: product_history.php?prod_name=$product_name");
  }else{
      $_SESSION['message']= "New service was not added!";
      header( "location: error.php" );
  }
    
    
/*Query that checks if the product is already in the db*/
$result = $mysqli->query("SELECT * FROM products WHERE product_name='$product_name'");
    
  if(!($result->num_rows>0)){
      
    $sql2 = "INSERT INTO products (product_name, units) "
                . "VALUES ('$product_name', '$units')";
    
    if($mysqli->query($sql2)===true){
                $_SESSION['message']= "New product added successfully!";
                header("location: product_history.php?prod_name=$product_name");
            }else{
                $_SESSION['message']= "New product was not added!";
                header( "location: error.php" );
    }
      
  }
    
}
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="src/css/style.css" />
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="src/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="src/js/jquery.autocomplete.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script> 
 jQuery(function(){ 
 $("#product_name").autocomplete("includes/search.php");
 });
 </script>

<script> 
 jQuery(function(){ 
 $("#venue").autocomplete("includes/search2.php");
 });
 </script>

<form class="form-horizontal" action="add_purchase.php" method="post" enctype="multipart/form-data">
<fieldset class= "myForm">
<legend>New Purchase</legend>

<!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>  
      <div class="col-md-4">
      <input name="q" value="<?php echo $productName?>" class="form-control input-md" required="" readonly>
      </div>
    </div>

<!-- Select Unit -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_categorie">PRODUCT UNITS</label>
      <div class="col-md-4">

    <input list="units" name="units" class="form-control" type="text">
        <datalist id= "units">
                                <option value = "ml">ml</option>
                                <option value = "littre">littre</option>
                                <option value = "klgr">klgr</option>
                                <option value = "gr">gr</option>
                                <option value = "item">item</option> 
        </datalist>
      </div>
    </div>
    
<!-- Enter Price -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_name">PRODUCT PRICE</label>  
      <div class="col-md-4">
      <input id="product_price" name="product_price" placeholder="PRODUCT PRICE" class="form-control input-md" required="" type="text" autocomplete= "off">

      </div>
    </div>
    
  
<!-- Enter Date -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_name">DATE</label>  
      <div class="col-md-4">
      <input type= "date" id="date_of" name="date_of" placeholder="DATE" class="form-control input-md" required="" type="text">

      </div>
    </div>
    
    
<!-- Enter Venue -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_name">VENUE</label>  
      <div class="col-md-4">
      <input id="venue" name="q2" placeholder="VENUE" class="form-control input-md" required="" type="text">

      </div>
    </div>
    
    
<!-- Enter Quantity -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_name">PRODUCT QUANTITY</label>  
      <div class="col-md-4">
      <input id="product_quantity" name="product_quantity" placeholder="PRODUCT QUANTITY" class="form-control input-md" required="" type="text">

      </div>
    </div>
    
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="submit" value="Add Purchase" name="modify" class="btn btn-block btn-primary" />
  </div>
  </div>

</fieldset>
</form>
