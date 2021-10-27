<?php
//include("header.php");
require("db.php");
include("src/functions.php");

/*Check if form submitted with  "post" method*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $product_name = $_POST['product_name'];
    // $product_id = 0;
    // $prod_type_id = 0;
    // $prod_category_id = 0;
    // $venue_id = 0;
    $units = $_POST['units'];
    $price = $_POST['product_price'];
    $prod_type = $_POST['product_type'];
    $prod_category = $_POST['product_category'];
    $date = $_POST['date_of'];
    $venue = $_POST['q2'];
    $qnt = $_POST['product_quantity'];
    $prc_per_qnt = $price/$qnt;
        
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

    /*Assign product id*/
    while($row= $result -> fetch_assoc()){
        $product_id = $row["product_id"];
    }
    

    /*Query that checks if the product type is already in the db*/
    $result = $mysqli->query("SELECT * FROM product_types WHERE type_name='$prod_type'");
        
        if(!($result->num_rows>0)){
            
            $sql2 = "INSERT INTO product_types (type_name) "
                        . "VALUES ('$prod_type')";
            
            if($mysqli->query($sql2)===true){
                        $_SESSION['message']= "New product added successfully!";
                        header("location: product_history.php?prod_name=$product_name");
                    }else{
                        $_SESSION['message']= "New product was not added!";
                        header( "location: error.php" );
            }
            
        }

        /*Assign type id*/
        while($row= $result -> fetch_assoc()){
            $prod_type_id = $row["product_type_id"];
        }
        

    /*Query that checks if the product category is already in the db*/
    $result = $mysqli->query("SELECT * FROM venues WHERE venue_name='$prod_category'");
        
        if(!($result->num_rows>0)){
            
            $sql2 = "INSERT INTO product_categories (category_name) "
                        . "VALUES ('$prod_category')";
            
            if($mysqli->query($sql2)===true){
                        $_SESSION['message']= "New product added successfully!";
                        header("location: product_history.php?prod_name=$product_name");
                    }else{
                        $_SESSION['message']= "New product was not added!";
                        header( "location: error.php" );
            }
            
        }
            
        /*Assign category id*/
        while($row= $result -> fetch_assoc()){
                $prod_category = $row["category_id"];
        }
        

    /*Query that checks if the venue is already in the db*/
    $result = $mysqli->query("SELECT * FROM venues WHERE venue_name='$venue'");
        
        if(!($result->num_rows>0)){
            
            $sql2 = "INSERT INTO venues (venue_name, units) "
                        . "VALUES ('$venue', '$units')";
            
            if($mysqli->query($sql2)===true){
                        $_SESSION['message']= "New product added successfully!";
                        header("location: product_history.php?prod_name=$product_name");
                    }else{
                        $_SESSION['message']= "New product was not added!";
                        header( "location: error.php" );
            }
            
        }
            
        /*Assign venue id*/
        while($row= $result -> fetch_assoc()){
                $venue_id = $row["venue_id"];
        }
        

    /*Query to add new purchase to the database*/
    $sql = "INSERT INTO purchases (product_id, 
                                    product_units, 
                                    product_price, 
                                    date_of_purchase, 
                                    venue_id, 
                                    qnt_of_product, 
                                    price_per_qnt,
                                    product_type_id
                                    VALUES ('$product_id', '$units', '$price', '$date', '$venue_id', '$qnt', '$prc_per_qnt', '$prod_type_id')";

    if($mysqli->query($sql)===true){
        $_SESSION['message']= "New service added successfully!";
        header("location: product_history.php?prod_name=$product_name");
    }else{
        $_SESSION['message']= "New service was not added!";
        header( "location: error.php" );
    }
    

}

// Query to return product names
    $prod_nam_qr = $mysqli -> query("SELECT DISTINCT product_name FROM products");

// Query to return venues
    $poss_venues = $mysqli -> query("SELECT DISTINCT venue FROM purchases");
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="src/css/style.css" />
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="src\js\jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="src\js\jquery.autocomplete.js"></script>
<!------ Include the above in your HEAD tag ---------->



<form class="form-horizontal" action="add_purchase.php" method="post" enctype="multipart/form-data">
<fieldset class= "myForm">
<legend>New Purchase</legend>

<!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>  
      <div class="col-md-4">
      <input list="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text" autofocus="autofocus" autocomplete="off">
        <datalist id="product_name">
            <?php
                while($row= $prod_nam_qr -> fetch_assoc()){
                    echo '<option value = '. $row["product_name"] .'>'. $row["product_id"] .'</option>';
                }
            ?>
        </datalist>

      </div>
    </div>

<!-- Datalist Unit -->
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
      <input list="venue" name="q2" placeholder="VENUE" class="form-control input-md" required="" type="text">
        <datalist id="venue">
            <?php
                while($row= $poss_venues -> fetch_assoc()){
                    echo '<option value = '. $row["venue"] .'>'. $row["product_id"] .'</option>';
                }
            ?>
        </datalist>

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
